<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChartOfAccount extends Model
{
    protected $fillable = [
        'name',
        'code',
        'type',
        'sub_type',
        'is_enabled',
        'description',
        'created_by',
    ];

    public function types()
    {
        return $this->hasOne('App\Models\ChartOfAccountType', 'id', 'type');
    }

    public function accounts()
    {
        return $this->hasOne('App\Models\JournalItem', 'account', 'id');
    }

    private $accountId;
    private $accountData;

    public function balance()
    {
        if($this->accountId == null)
        {
            $journalItem         = JournalItem::select(\DB::raw('sum(credit) as totalCredit'), \DB::raw('sum(debit) as totalDebit'), \DB::raw('sum(credit) - sum(debit) as netAmount'))->where('account', $this->id);
            $journalItem         = $journalItem->first();

            $data['totalCredit'] = $journalItem->totalCredit;
            $data['totalDebit']  = $journalItem->totalDebit;
            $data['netAmount']   = $journalItem->netAmount;
            $this->accountId     = $this->id;
            $this->accountData   = $data;
        }

        return $this->accountData;
    }

    public function subType()
    {
        return $this->hasOne('App\Models\ChartOfAccountSubType', 'id', 'sub_type');
    }
}
