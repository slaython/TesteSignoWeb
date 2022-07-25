<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Helpers
{
    /* TOASTS PADRÕES DA DASHBOARD */
    public function ToastError(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-cross-circle-fill', 'classe' => 'error', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    public function ToastInfo(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-info-fill', 'classe' => 'info', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    public function ToastSucesso(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-check-circle', 'classe' => 'success', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    public function ToastAlerta(string $Mensagem){
        return ['show' => true, 'icon' => 'ni ni-alert-fill', 'classe' => 'warning', 'position' => 'top-right', 'mensagem' => $Mensagem];
    }

    //DEFINE A REQUISIÇÃO PARA RETORNOS JSON
    public function Requisicao(){
        $Resposta = [
        'resposta' => [
            'data' => [],
            'redirect' => false,
            'loading' => false,
            'toast' => [
                    'icon' => 'ni ni-alert-fill',
                    'classe' => 'info',
                    'position' => 'top-right',
                    'mensagem' => 'Mensagem padrão, favor alterar!',
                    'show' => true
                ]
            ],
        'error' => [
            'erro' => false,
            'codigo' => '',
            'mensagem' => '',
            ]
        ];
        return $Resposta;
    }

    //MONTA O MENU
    public function Menu(){
        $QrMenu = "SELECT ID, NOME, CAMINHO, ICONE FROM SWMENU";
        $Menu = DB::connection()->select($QrMenu);
        if(!empty($Menu)){
            return $Menu;
        }
        return [];
    }

    //RETORNAS TOAS AS ESQUETES
    public function Enquetes(){
        $QrEnquetes = "
            SELECT
                ID,
                TITULO,
                DATAINICIO,
                DATAFIM,
                DESCRICAO,
                STATUS,
                ICONE
            FROM
                swenquetes
            WHERE
                STATUS != 3
        ";
        $Enquetes = DB::connection()->select($QrEnquetes);
        if(!empty($Enquetes)){
            foreach ($Enquetes as $Enquete) {
                $Enquete->DATAINICIO = $this->DataFormatoView($Enquete->DATAINICIO);
            }
            return $Enquetes;
        }
        return [];
    }

    public function Enquete($ID){
        $QrEnquete = "
            SELECT
                ID,
                TITULO,
                DATAINICIO,
                DATAFIM,
                DESCRICAO,
                STATUS,
                ICONE
            FROM
                swenquetes
            WHERE
                ID = {$ID}
        ";
        $Enquete = DB::connection()->selectOne($QrEnquete);
        if(!empty($Enquete)){
            $Enquete->DATAINICIO = $this->DataFormatoView($Enquete->DATAINICIO);
            $Enquete->DATAFIM = $this->DataFormatoView($Enquete->DATAFIM);
            return $Enquete;
        }
        return [];
    }

    public function Respostas($ID){
        $QrRespostas = "
            SELECT
                RESPOSTA,
                IDRESPOSTA
            FROM
                swrespostasenquetes
            WHERE
                IDENQUETE = {$ID}
        ";
        $Respostas = DB::connection()->select($QrRespostas);
        if(!empty($Respostas)){
            return $Respostas;
        }
        return [];
    }

    public static function QntVotos($IDENQUETE, $IDRESPOSTA){
        $QrVotos = "
        SELECT
            COUNT(*) AS VOTOS
        FROM
            swvotos
        WHERE
            IDENQUETE = {$IDENQUETE}
            AND IDRESPOSTA = {$IDRESPOSTA}
        ";
        $Votos = DB::connection()->selectOne($QrVotos);
        if (!empty($Votos)) {
            return $Votos;
        }
        return "0";
    }

    public static function QntTotalVotos($IDENQUETE){
        $QrVotos = "
        SELECT
            COUNT(*) AS VOTOS
        FROM
            swvotos
        WHERE
            IDENQUETE = {$IDENQUETE}
        ";
        $Votos = DB::connection()->selectOne($QrVotos);
        if (!empty($Votos)) {
            return $Votos;
        }
        return "0";
    }

    public static function diasDatas($data_inicial, $data_final) {
        $diferenca = strtotime($data_final) - strtotime($data_inicial);
        $dias = floor($diferenca / (60 * 60 * 24)); 
        return $dias;
    }

    //VERIFICA SE É UMA DTA VÁLIDA
	public function DataValida(string $data){
		$Data = explode('/', $data);
		return checkdate($Data[1], $Data[0], $Data[2]);
	}

    //FORMATA A DATA PARA INSERÇÃO NO BANCO
	public function DataFormatoBanco(string $data){
		$Data = explode('/', $data);
		return "$Data[2]-$Data[1]-$Data[0]";
	}

    //FORMATA A DATA PARA INSERÇÃO NO BANCO
	public function DataFormatoView(string $data){
		$Data = explode('-', $data);
		return "$Data[2]/$Data[1]/$Data[0]";
	}

    public function TimeStampFormatoView(string $DATA){
		$Data = explode(' ', $DATA);
		$data = explode('-', $Data[0]);
		return "$data[2]/$data[1]/$data[0]";
	}

	//FORMATA O TIMESTAMP PARA INSERÇÃO NO BANCO
	public function TimeStampFormatoBanco(string $data){
		$Data = explode(' ', $data);
		$DataData = explode('/', $Data[0]);
		return "$DataData[2]-$DataData[1]-$DataData[0] $Data[1]:00";
	}
}