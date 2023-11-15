<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class UserService
{
    public function getUsersOnline()
    {
        return User::where('status', User::ON)->get();
    }

    public function getUsers()
    {
        return User::all();
    }

    public function formatDate($date)
    {
        return date("d.m.Y", strtotime($date));
    }

    public function formatData($request)
    {
        $data = $request->input();
        unset($data['_token']);

        return $data;
    }

    public function update($request, $user)
    {
        try{
            DB::beginTransaction();

            $user->fill($this->formatData($request));
            $user->save();

            DB::commit();
            Session::flash('success', 'Update my account success');
        }catch(\Exception $e){
            Session::flash('error', $e->getMessage());
            return false;
        }

        return true;
    }

    public function getRangeCompleted($user)
    {
        $userFillable = $user->fillable;
        $total = count($userFillable) - 1;
        $fieldCompleted = 0;
        foreach($userFillable as $key => $value){
            !empty($user[$value]) ? $fieldCompleted++ : null;
        }

        return $fieldCompleted / $total;
    }
}
