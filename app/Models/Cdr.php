<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Cdr
 * 
 * @property Carbon $calldate
 * @property string $clid
 * @property string $src
 * @property string $dst
 * @property string $dcontext
 * @property string $channel
 * @property string $dstchannel
 * @property string $lastapp
 * @property string $lastdata
 * @property int $duration
 * @property int $billsec
 * @property string $disposition
 * @property int $amaflags
 * @property string $accountcode
 * @property string $uniqueid
 * @property string $userfield
 * @property string $did
 * @property string $recordingfile
 * @property string $cnum
 * @property string $cnam
 * @property string $outbound_cnum
 * @property string $outbound_cnam
 * @property string $dst_cnam
 * @property string $prime_dst
 * @property string $bit_dst
 * @property string $enjoy_dst
 * @property string $daon_dst
 * @property string $pnp_dst
 * @property string $daon_ivr
 * @property string $happyeco_dst
 * @property string $bisen_dst
 * @property int $answer_time
 * @property int $hangup_time
 *
 * @package App\Models
 */
class Cdr extends Model
{
	protected $table = 'cdr';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'duration' => 'int',
		'billsec' => 'int',
		'amaflags' => 'int',
		'answer_time' => 'int',
		'hangup_time' => 'int'
	];

	protected $dates = [
		'calldate'
	];

	protected $fillable = [
		'calldate',
		'clid',
		'src',
		'dst',
		'dcontext',
		'channel',
		'dstchannel',
		'lastapp',
		'lastdata',
		'duration',
		'billsec',
		'disposition',
		'amaflags',
		'accountcode',
		'uniqueid',
		'userfield',
		'did',
		'recordingfile',
		'cnum',
		'cnam',
		'outbound_cnum',
		'outbound_cnam',
		'dst_cnam',
		'prime_dst',
		'bit_dst',
		'enjoy_dst',
		'daon_dst',
		'pnp_dst',
		'daon_ivr',
		'happyeco_dst',
		'bisen_dst',
		'answer_time',
		'hangup_time'
	];
}
