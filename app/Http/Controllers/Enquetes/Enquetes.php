<?php

namespace App\Http\Controllers\Enquetes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class Enquetes extends Controller
{
    ////CADASTRO DE USUÁRIOS
    public function CadastroEnquete(Request $Request){
        //MONTA A REQUISICAO
        $Requisicao = $this->Helpers->Requisicao();
        //VALIDAÇÃO DOS DADOS INFORMADOS PELO USUARIO
        $Validacao = Validator::make($Request->all(),
            [
                'TITULO' => 'required|min:10|max:50',
                'DATAINICIO' => 'required',
                'DATAFIM' => 'required',
                'DESCRICAO' => 'required',
                'PRIMEIRARESPOSTA' => 'required|min:1',
                'SEGUNDARESPOSTA' => 'required|min:1',
                'TERCEIRARESPOSTA' => 'required|min:1',
            ],
            [
                'TITULO.required' => "O campo TITULO é obrigatório!",
                'TITULO.min' => "O campo TITULO precisa de no mínimo 10 caracteres!",
                'TITULO.max' => "O campo TITULO pode ter até 50 caracteres!",
                'DATAINICIO.required' => "O campo DATA INICIO é obrigatório!",
                'DATAFIM.required' => "O campo DATA FIM é obrigatório!",
                'PRIMEIRARESPOSTA.required' => "O campo PRIMEIRA RESPOSTA é obrigatório!",
                'PRIMEIRARESPOSTA.min' => "O campo PRIMEIRA RESPOSTA precisa ter no mínimo 1 caractere!",
                'SEGUNDARESPOSTA.required' => "O campo SEGUNDA RESPOSTA é obrigatório!",
                'SEGUNDARESPOSTA.min' => "O campo SEGUNDA RESPOSTA precisa ter no mínimo 1 caractere!",
                'TERCEIRARESPOSTA.required' => "O campo TERCEIRA RESPOSTA é obrigatório!",
                'TERCEIRARESPOSTA.min' => "O campo TERCEIRA RESPOSTA precisa ter no mínimo 1 caractere!",
            ]
        );
        //VALIDA SE EXISTE ERROS
        if(!empty($Validacao->errors()->first())){
    		$Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta($Validacao->errors()->first());
    		return response()->json($Requisicao);
	    }
        //VERIFICA SE A DATA É VALIDA
        if(!empty($Request->DATAINICIO)){
            $Data = $this->Helpers->DataValida($Request->DATAINICIO);
            if($Data == false){
                $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta(
                    "O campo DATA INICIO precisa ser uma data válida!");
                return response()->json($Requisicao);
            }
        }
        if(!empty($Request->DATAFIM)){
            $Data = $this->Helpers->DataValida($Request->DATAFIM);
            if($Data == false){
                $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta(
                    "O campo DATA FIM precisa ser uma data válida!");
                return response()->json($Requisicao);
            }
        }
        //FORMATA PARA INSERSSÃO NO BANCO
        if(!empty($Request->DATAINICIO)){
            $Request->DATAINICIO = $this->Helpers->DataFormatoBanco($Request->DATAINICIO);
        }
        if(!empty($Request->DATAFIM)){
            $Request->DATAFIM = $this->Helpers->DataFormatoBanco($Request->DATAFIM);
        }
        //CADASTRA O USUARIO NO BANCO
        $ArrEnquete = [
            'TITULO' => $Request->TITULO,
            'DATAINICIO' => $Request->DATAINICIO,
            'DATAFIM' => $Request->DATAFIM,
            'DESCRICAO' => $Request->DESCRICAO,
            'CRIADOEM' => date('Y-m-d H:i:s'),
            'MODIFICADOEM' => null,
            'ICONE' => '<em class="icon ni ni-cc-alt2-fill"></em>',
            'STATUS' => 1
        ];
        $ArrRespostas = [
            $Request->PRIMEIRARESPOSTA,
            $Request->SEGUNDARESPOSTA,
            $Request->TERCEIRARESPOSTA,
            $Request->QUARTARESPOSTA,
            $Request->QUINTARESPOSTA,
        ];
        $Enquete = DB::table('swenquetes')->insertGetId($ArrEnquete);
        if(!empty($Enquete)){
            //CADASTRO RESPOSTAS
            foreach($ArrRespostas as $Resposta){
                $ArrResposta = [
                    'RESPOSTA' => $Resposta,
                    'IDENQUETE' => $Enquete,
                ];
                $Respostas = DB::table('swrespostasenquetes')->insertGetId($ArrResposta);
            }
            //RESGATA OS DADOS DO USUARIO CADASTRADO
            $ArrEnquete['ID'] = $Enquete;
            //DADOS DO NOVO CADASTRO
            $Requisicao['resposta']['data']['enquete'] = $ArrEnquete;
            //INFORMA SE OS DADOS FORAM CADASTRADOS
            $Requisicao['resposta']['data']['insert'] = true;
            //MENSAGEM DE SUCESSO
            $Requisicao['resposta']['toast'] = $this->Helpers->ToastSucesso(
                "Enquete cadastrada com sucesso!"
            );
            //MONTA HTML DO USUÁRIO NA TABELA USUÁRIOS
            // $Requisicao['resposta']['data']['html_enquete'] = $this->Helpers->HTMLenquete($ArrCadastro);
            return response()->json($Requisicao);
        }

        //MENSAGEM DE ALERTA
        $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta(
            "Enquete não cadastrada!"
        );
        return response()->json($Requisicao);
    }

    public function Votacao(Request $Request){
        //MONTA A REQUISICAO
        $Requisicao = $this->Helpers->Requisicao();
        //VALIDAÇÃO DOS DADOS INFORMADOS PELO USUARIO
        $Validacao = Validator::make($Request->all(),
            [
                'IDRESPOSTA' => 'required',
                'IDENQUETE' => 'required',
            ],
            [
                'IDRESPOSTA.required' => "Escolha uma das opções para completar seu voto!",
                'IDENQUETE.required' => "Algo deu errado, recarregue a página e tente novamente!",
            ]
        );
        //VALIDA SE EXISTE ERROS
        if(!empty($Validacao->errors()->first())){
            //INFORMA SE OS DADOS FORAM CADASTRADOS
            $Requisicao['resposta']['data']['insert'] = false;
    		$Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta($Validacao->errors()->first());
    		return response()->json($Requisicao);
	    }
        $ArrVoto = [
            'IDRESPOSTA' => $Request->IDRESPOSTA, 
            'IDENQUETE' => $Request->IDENQUETE,
        ];
        $Voto = DB::table('swvotos')->insertGetId($ArrVoto);
        if(!empty($Voto)){
            //DEFINE A ROTA PARA O REDIRECIONAMENTO
            $Requisicao['resposta']['redirect'] = "/enquete-$Request->IDENQUETE";
            //INFORMA SE OS DADOS FORAM CADASTRADOS
            $Requisicao['resposta']['data']['insert'] = true;
            return response()->json($Requisicao);
        }
        //MENSAGEM DE ALERTA
        $Requisicao['resposta']['toast'] = $this->Helpers->ToastAlerta(
            "Algo deu errado, recarregue a pagina e tente novamente!"
        );
        return response()->json($Requisicao);
    }
}
