<?php

namespace Vadiasov\TracksAdmin\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackRequest extends FormRequest
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
            'album_id'    => ['required'],
            'title'        => ['required', 'regex:/^[a-zA-Z\-\' ]+$/u'],
            'release_date' => ['required'],
            'price'        => ['required', 'between:0,999.99'],
            'free'         => ['required', 'string', 'size:1'],
            'donate'       => ['required', 'string', 'size:1'],
            'genres'       => ['required', 'array'],
            'editor1'      => ['required'],
        ];
    }
}
