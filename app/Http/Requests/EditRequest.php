<?php

namespace App\Http\Requests;

use App\DTO\Record\EditRecord;
use DemeterChain\C;
use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cost' => 'required|integer|min:3',
            'name' => 'required|min:4'
        ];
    }

    public function convertToDto(): EditRecord
    {
        return new EditRecord($this->id, $this->_token, $this->cost, $this->select, $this->name);
    }
}
