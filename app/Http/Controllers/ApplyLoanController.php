<?php

namespace App\Http\Controllers;

use App\Models\ApplyLoan;
use Illuminate\Http\Request;
use App\Helper\RBAC;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailContact;

class ApplyLoanController extends Controller
{
    protected function dataList()
    {
        return ApplyLoan::get();
    }

    public function view()
    {
        if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
            //return redirect to authourized
            return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
        }
        return View('AdminMenu.ApplyLoan.index');
    }

    public function index()
    {
        try {
            if (!RBAC::isAccessible(str_replace('Controller', '', class_basename(Route::current()->controller)) . '-' . Route::getCurrentRoute()->getActionMethod())) {
                //return redirect to authourized
                return ['result' => 'error', 'msg' => 'Unauthorized Action', 'data' => ''];
            }
            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'data' => $this->dataList(),
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Menu Index Error!',
                    'result' => $th,
                    'data' => [],
                ]
            );
        }
    }

    public function applyLoanSubmit(Request $request)
    {
        try {
            $validation = Validator($request->all(), [
                'loan_amount' => 'required',
                'monthly_income' => 'required',
                'purpose_loan' => 'required',
                'loan_year' => 'required',
                'full_name' => 'required',
                'email' => 'required|unique:apply_loans',
                'phone_number' => 'required',
                'marital_status' => 'required',
                'date_birth' => 'required',
                'number_dependents' => 'required',
                // 'house_no',
                // 'street',
                'province' => 'required',
                'city' => 'required',
                'country' => 'required',


            ]);
            if ($validation->fails()) {
                return response()->json(
                    [
                        'status' => 'error',
                        'icon' => 'error',
                        'result' => $validation->getMessageBag()
                    ]
                );
            }
            ApplyLoan::create($request->all());
            // sent Mail
            $mailTo = $request->email;
            $userApllyLoan = [
                'subject' => 'Thanks you for your Apply loan!',
                'loanamount' => $request->get('loan_amount'),
                'monthlyincome' => $request->get('monthly_income'),
                'purposeloan' => $request->get('purpose_loan'),
                'loanyear' => $request->get('loan_year'),
                'fullname' => $request->get('full_name'),
                'email' => $request->get('email'),
                'phonenumber' => $request->get('phone_number'),
                'maritalstatus' => $request->get('marital_status'),
                'datebirth' => $request->get('date_birth'),
                'numberdependents' => $request->get('number_dependents'),
                'houseno' => $request->get('house_no'),
                'street' => $request->get('street'),
                'province' => $request->get('province'),
                'city' => $request->get('city'),
                'country' => $request->get('country'),
            ];
            Mail::to($mailTo)->send(new MailContact($userApllyLoan));
            return response()->json(
                [
                    'status' => 'success',
                    'icon' => 'success',
                    'msg' => 'Sent Message Contact Success!',
                    'data' => [],
                ]
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'status' => 'error',
                    'icon' => 'error',
                    'msg' => 'Get Data Message Contact Index Error!',
                    'result' => $th->getMessage(),
                    'data' => [],
                ]
            );
        }
    }
}
