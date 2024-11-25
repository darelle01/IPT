<?php

namespace App\Http\Controllers;

use App\Models\AccountsModel;
use Illuminate\Http\Request;

class AccountListViewController extends Controller
{
    public function ViewAccountList()
    {
        $AllActiveAccounts = AccountsModel::where('Position', 'Staff')
                                    ->where('Status', 'Active')
                                    ->get();
        
        $AllDeactivedAccounts = AccountsModel::where('Position', 'Staff')
                                    ->where('Status', 'Deactivated')
                                    ->get();
        if ($AllActiveAccounts->isEmpty() && $AllDeactivedAccounts->isEmpty()) { 
            return view('AdminPages.AccountList', compact('AllActiveAccounts', 'AllDeactivedAccounts')) ->with(['NoAccount' => 'No Accounts']); 
        }
        return view('AdminPages.AccountList',compact(['AllActiveAccounts','AllDeactivedAccounts']));
    }
}