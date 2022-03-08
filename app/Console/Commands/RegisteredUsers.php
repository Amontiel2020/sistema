<?php

namespace App\Console\Commands;

use App\Mail\SendMailable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use App\Pagamento;
use Carbon\Carbon;

class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
     /*   $pagamentos = DB::table('pagamentos')
        ->whereRaw('Date(created_at) = CURDATE()')
        ->get();
*/
        $date = Carbon::now();
        $date = $date->format('y-m-d');
    
    
        $pagamentos = Pagamento::whereDate('created_at', $date)->get();
        $totalInscricao =  Pagamento::whereDate('created_at', $date)
        ->where("mes", 1)->sum('valor');
        $totalMatricula =  Pagamento::whereDate('created_at', $date)
        ->where("mes", 2)->sum('valor');
        $totalPropinas =  Pagamento::whereDate('created_at', $date)
        ->where("mes",'<>',1)
        ->where("mes",'<>',2)
        ->sum('valor');
        // $pagamentosDia = DB::table('pagamentos')->select('valor')->where('created_at',$date)->get();
        $total = $pagamentos->sum('valor');
        
     //   $pdf = PDF::loadView("caixa.pagamentosDiaEmail", compact('pagamentos', 'total','totalInscricao','totalMatricula','totalPropinas'));
      //  $pdf = PDF::loadView("caixa.pagamentosDiaEmail", compact('pagamentos'));
        
//$pagamentos,$totalInscricao,$totalMatricula,$totalPropinas,$total
        Mail::to('adan.montiel@gmail.com')->send(new SendMailable($pagamentos,$totalInscricao,$totalMatricula,$totalPropinas,$total));
        
    }
}
