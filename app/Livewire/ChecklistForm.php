<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\checklist as Checklist;
use App\Models\preparation_checklist as PrepCheck;
use App\Models\OBA_Kit_Checklist as OBACheck;
use App\Models\shipment_information as ShipInfo;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ChecklistForm extends Component
{
    public $checklistInfo = [];
    public $model_id = "";




    public function mount($model_id){
        $this->model_id = $model_id;
        $this->checklistInfo = Checklist::find($model_id);
    }

    public function save(){
        $this->dispatch('save-clicked');
    }

    private function validateField($fieldValue)
    {
        return ($fieldValue == 1) ? 1 : 0;
    }

    #[On('return-value')]
    public function displayData($param)
    {
        //dd($param);
        DB::beginTransaction();
        try{
            if($param['Child Component'] == "Preparation Checklist"){
                $checklist = PrepCheck::where('checklist_id', $this->model_id)->first();
                $inputData = $param['Data'];
                if ($checklist) {
                    $checklist->update($inputData);
                }
            }elseif($param['Child Component'] == 'OBA Kit Checklist'){
                $checklist = OBACheck::where('checklist_id', $this->model_id)->first();
                $inputData = $param['Data'];
                if ($checklist) {
                    $checklist->update($inputData);
                }
            }elseif($param['Child Component'] == 'Shipment Information'){
                $checklist = ShipInfo::where('checklist_id', $this->model_id)->first();
                $inputData = $param['Data'];
                if ($checklist) {
                    $checklist->update($inputData);
                }
            }

            DB::commit();
        }catch(\Exception $e){
            DB::rollBack();
        }

    }

    public function render()
    {
        return view('livewire.checklist-form');
    }


}
