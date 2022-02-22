<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ApiPaymentController extends Controller
{
  protected function inputModifier(array $data): array
  {
      if ( isset($data['value']) ) {
        $data['value'] = str_replace('.','',$data['value']);
        $data['value'] = str_replace(',','.',$data['value']);
      }

      return $data;
  }

  protected function validator(array $data)
  {
    return Validator::make($data, [
      'provider_id' => ['nullable','numeric', 'min:1'],
      'payment_type_id' => ['nullable','numeric', 'min:1'],
      'payment_method_id' => ['nullable','numeric', 'min:1'],
      'due_date' => ['required','date'],
      'description' => ['string','min:0','max:1000'],
      'bar_code' => ['nullable','string','min:0','max:1000'],
      'value' => ['nullable', 'numeric'],
      'payed' => ['nullable', 'boolean'],
    ]);
  }

}
