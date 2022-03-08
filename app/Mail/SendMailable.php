<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;

     public $pagamentos;    
     public $totalInscricao;
      public $totalMatricula;
      public $totalPropinas;
      public $total;
   



    //$pagamentos,$totalInscricao,$totalMatricula,$totalPropinas,$total
    public function __construct($pagamentos,$totalInscricao,$totalMatricula,$totalPropinas,$total)
    {
      

       $this->pagamentos = $pagamentos;
       $this->totalInscricao = $totalInscricao;
       $this->totalMatricula = $totalMatricula;
       $this->totalPropinas = $totalPropinas;
       $this->total = $total;
    }
    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('emails.registeredcount')
        ->subject('Pagamentos de Hoje');
  //          ->attachData($this->pdf, 'name.pdf', [
  //              'mime' => 'application/pdf',
    //        ]);
    }
}
