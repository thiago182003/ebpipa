<?php

namespace App\Http\Controllers;

use App\Models\Anexo;
use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Edital;
use App\Models\Empresa_user;
use App\Models\empresaCredenciamento;
use App\Models\endereco;
use App\Models\Om;
use App\Models\Pipeiro_user;
use App\Models\pipeiroCredenciamento;
use App\Models\veiculo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CredenciamentoController extends Controller
{
    
    private static function checarPendenciasEndereco($credenciamento){
        // dd($endereco);
        $pendencias = [];
        if ($credenciamento->endereco != null) {
            if ($credenciamento->endereco->comprovanteresidencia_status != 1 && $credenciamento->endereco->comprovanteresidencia_status != 2) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'comprovanteresidencia',
                    'nome' => 'Comprovante de Residência',
                    'obs' => $credenciamento->endereco->comprovanteresidencia_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        return $pendencias;
    }

    private static function checarPendenciasVeiculo($credenciamento){
        $pendencias = [];
        if ($credenciamento->veiculo != null) {
            if (@$credenciamento->veiculo->doc_crlv_status != 1 && @$credenciamento->veiculo->doc_crlv_status != 2) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_crlv',
                    'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                    'obs' => $credenciamento->veiculo->doc_crlv_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->veiculo->doc_lav_status == 99) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_lav',
                    'nome' => 'Laudo de aferição de volume do tanque',
                    'obs' => $credenciamento->veiculo->doc_lav_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->veiculo->veiculo_img_status != 1 && @$credenciamento->veiculo->veiculo_img_status != 2) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'veiculo_img',
                    'nome' => 'Foto do Caminhão',
                    'obs' => $credenciamento->veiculo->veiculo_img_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if ($credenciamento->veiculo->proprio == 0) {
                //22
                if (@$credenciamento->veiculo->doc_cl_status != 1 && @$credenciamento->veiculo->doc_cl_status != 2) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'doc_cl',
                        'nome' => 'Contrato de locação do veículo',
                        'obs' => $credenciamento->veiculo->doc_cl_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
        }
        return $pendencias;
    }

    private static function checarPendenciasDadosBancarios($credenciamento){
        $pendencias = [];
        if ($credenciamento->dadosbancarios != null) {
            //06
            if (@$credenciamento->dadosbancarios->doc_comprovante_status != 1 && @$credenciamento->dadosbancarios->doc_comprovante_status != 2) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_comprovante',
                    'nome' => 'Comprovante de Dados Bancarios',
                    'obs' => $credenciamento->dadosbancarios->doc_comprovante_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        return $pendencias;
    }

    private static function checarPendenciasPipeiro($credenciamento){
        $pendencias = [];
        if ($credenciamento->pipeiro != null) {
            if (@$credenciamento->pipeiro->cnhfrente_status != 1 && @$credenciamento->pipeiro->cnhfrente_status != 2) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'cnhfrente',
                    'nome' => 'Foto da CNH',
                    'obs' => $credenciamento->pipeiro->cnhfrente_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //13
            if (@$credenciamento->pipeiro->genero == 1) {
                if ($credenciamento->doc_cqsm_status != 1 && $credenciamento->doc_cqsm_status != 2) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'doc_cqsm',
                        'nome' => 'Certidão de Quitação com o Serviço Militar (para o sexo masculino)',
                        'obs' => $credenciamento->doc_cqsm_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
        }
        return $pendencias;
    }

    private static function checarPendenciasPipeiroDocs($credenciamento){
        $pendencias = [];
        if (@$credenciamento->doc_reqcred_status != 1 && @$credenciamento->doc_reqcred_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_reqcred',
                'nome' => 'Requerimento de Credenciamento',
                'obs' => $credenciamento->doc_reqcred_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //09
        if (@$credenciamento->doc_drctvc_status != 1 && @$credenciamento->doc_drctvc_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_drctvc',
                'nome' => 'Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado',
                'obs' => $credenciamento->doc_drctvc_obs
            ];
            array_push($pendencias, $pendencia);
        }   
        //08
        if (@$credenciamento->doc_cico_status != 1 && @$credenciamento->doc_cico_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cico',
                'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações',
                'obs' => $credenciamento->doc_cico_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //11
        if (@$credenciamento->doc_cicips_status != 1 && @$credenciamento->doc_cicips_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cicips',
                'nome' => 'Comprovante de Inscrição como Contribuinte Individual da Previdência Social',
                'obs' => $credenciamento->doc_cicips_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //12
        if (@$credenciamento->doc_cqe_status != 1 && @$credenciamento->doc_cqe_status != 2 ) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cqe',
                'nome' => 'Certidão de Quitação Eleitoral',
                'obs' => $credenciamento->doc_cqe_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //10
        if (@$credenciamento->doc_maed_status != 1 && @$credenciamento->doc_maed_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_maed',
                'nome' => 'Modelo de autorização para exposição de dados',
                'obs' => $credenciamento->doc_maed_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //15
        if (@$credenciamento->doc_ciscc_status != 1 && @$credenciamento->doc_ciscc_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_ciscc',
                'nome' => 'Comprovante de situação cadastral no CPF',
                'obs' => $credenciamento->doc_ciscc_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //16
        if (@$credenciamento->doc_cndf_status != 1 && @$credenciamento->doc_cndf_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cndf',
                'nome' => 'Certidão de Regularidade para com a Fazenda Federal',
                'obs' => $credenciamento->doc_cndf_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //17
        if (@$credenciamento->doc_cnde_status != 1 && @$credenciamento->doc_cnde_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cnde',
                'nome' => 'Certidão de Regularidade para com a Fazenda Estadual',
                'obs' => $credenciamento->doc_cnde_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //18
        if (@$credenciamento->doc_cndm_status != 1 && @$credenciamento->doc_cndm_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cndm',
                'nome' => 'Certidão Negativa de Débitos Municipais',
                'obs' => $credenciamento->doc_cndm_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //19
        if (@$credenciamento->doc_cidt_status != 1 && @$credenciamento->doc_cidt_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_cidt',
                'nome' => 'Certidão de Inexistência de Débitos Trabalhistas',
                'obs' => $credenciamento->doc_cidt_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //20
        if (@$credenciamento->doc_antt_status != 1 && @$credenciamento->doc_antt_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_antt',
                'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                'obs' => $credenciamento->doc_antt_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //21
        if (@$credenciamento->doc_lvs_status != 1 && @$credenciamento->doc_lvs_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_lvs',
                'nome' => 'Laudo da Vigilância Sanitária',
                'obs' => $credenciamento->doc_lvs_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //14
        if (@$credenciamento->doc_sicaf_status != 1 && @$credenciamento->doc_sicaf_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_sicaf',
                'nome' => 'SICAF',
                'obs' => $credenciamento->doc_sicaf_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //23
        if (@$credenciamento->doc_act_status == 99) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_act',
                'nome' => 'Atestado de capacidade técnica',
                'obs' => $credenciamento->doc_act_obs
            ];
            array_push($pendencias, $pendencia);
        }
        return $pendencias;
    }

    private static function checarPendenciasdaEmpresa($credenciamento){
        $pendencias = [];
        $empresa = $credenciamento->empresa;
        if ($empresa != null) {
            //02
            if (@$empresa->doc_representante_status != 1 && @$empresa->doc_representante_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_representante',
                    'nome' => 'Documento do representante',
                    'obs' => $empresa->doc_representante_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //05
            if (@$empresa->doc_emp_tdm_status != 1 && @$empresa->doc_emp_tdm_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_tdm',
                    'nome' => 'Declaração de trabalho de menor',
                    'obs' => $empresa->doc_emp_tdm_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //07
            if (@$empresa->doc_emp_ccmei_status != 1 && @$empresa->doc_emp_ccmei_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_ccmei',
                    'nome' => 'Documento de Constituição da Empresa',
                    'obs' => $empresa->doc_emp_ccmei_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //08
            if (@$empresa->doc_emp_cicnpj_status != 1 && @$empresa->doc_emp_cicnpj_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_cicnpj',
                    'nome' => 'Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ',
                    'obs' => $empresa->doc_emp_cicnpj_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //09
            if (@$empresa->doc_emp_ciccem_status != 1 && @$empresa->doc_emp_ciccem_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_ciccem',
                    'nome' => 'Certidão de inscrição no cadastro de contribuintes estadual ou municipal, correspondente a sede do interessado',
                    'obs' => $empresa->doc_emp_ciccem_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //15
            if (@$empresa->doc_emp_cidijt_status != 1 && @$empresa->doc_emp_cidijt_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_cidijt',
                    'nome' => 'Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho',
                    'obs' => $empresa->doc_emp_cidijt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //17
            if (@$empresa->doc_emp_alf_status != 1 && @$empresa->doc_emp_alf_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_alf',
                    'nome' => 'Alvará de licença de funcionamento',
                    'obs' => $empresa->doc_emp_alf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //13
            if (@$empresa->doc_emp_crrcss_status != 1 && @$empresa->doc_emp_crrcss_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_crrcss',
                    'nome' => 'Certidão de regularidade relativa as contribuições para a Seguridade Social',
                    'obs' => $empresa->doc_emp_crrcss_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //14
            if (@$empresa->doc_emp_crrc_status != 1 && @$empresa->doc_emp_crrc_status != 2) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_emp_crrc',
                    'nome' => 'Certidão de regularidade com referência às contribuições para o FGTS',
                    'obs' => $empresa->doc_emp_crrc_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        return $pendencias;
    }

    private static function checarPendenciasEmpresaDocs($credenciamento){
        $pendencias = [];
        if (@$credenciamento->doc_cico_status != 1 && @$credenciamento->doc_cico_status != 2) {
            $pendencia = [
                "edital" => $credenciamento->id_edital,
                'id' => 'doc_cico',
                'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações',
                'obs' => $credenciamento->doc_cico_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //06
        if (@$credenciamento->doc_maed_status != 1 && @$credenciamento->doc_maed_status != 2) {
            $pendencia = [
                "edital" => $credenciamento->id_edital,
                'id' => 'doc_maed',
                'nome' => 'Modelo de autorização para exposição de dados',
                'obs' => $credenciamento->doc_maed_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //10
        if (@$credenciamento->doc_cndf_status != 1 && @$credenciamento->doc_cndf_status != 2) {
            $pendencia = [
                "edital" => $credenciamento->id_edital,
                'id' => 'doc_cndf',
                'nome' => 'Certidão de regularidade com a Fazenda Federais',
                'obs' => $credenciamento->doc_cndf_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //12
        if (@$credenciamento->doc_cndm_status != 1 && @$credenciamento->doc_cndm_status != 2) {
            $pendencia = [
                "edital" => $credenciamento->id_edital,
                'id' => 'doc_cndm',
                'nome' => 'Certidão de regularidade com a Fazenda Municipal',
                'obs' => $credenciamento->doc_cndm_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //11
        if (@$credenciamento->doc_cnde_status != 1 && @$credenciamento->doc_cnde_status != 2) {
            $pendencia = [
                "edital" => $credenciamento->id_edital,
                'id' => 'doc_cnde',
                'nome' => 'Certidão de regularidade com a Fazenda Estadual',
                'obs' => $credenciamento->doc_cnde_obs
            ];
            array_push($pendencias, $pendencia);
        }
        //18
        if ($credenciamento->doc_act_status == 99) {
            $pendencia = [
                "edital" => $credenciamento->id_edital,
                'id' => 'doc_act',
                'nome' => 'Atestado de Capacidade Técnica',
                'obs' => $credenciamento->doc_act_obs
            ];;
            array_push($pendencias, $pendencia);
        }
        //16
        if (@$credenciamento->doc_sicaf_status != 1 && @$credenciamento->doc_sicaf_status != 2) {
            $pendencia = [
                'edital' => $credenciamento->id_edital,
                'id' => 'doc_sicaf',
                'nome' => 'SICAF',
                'obs' => $credenciamento->doc_sicaf_obs
            ];
            array_push($pendencias, $pendencia);
        }
        return $pendencias;
    }

    static public function checarPendencias($id,$idcred = 0)
    {
        $pendencias = [];
        $credenciamentos = credenciamento::pipeiroCompleto($id,$idcred);
        
        foreach($credenciamentos as $credenciamento){
            if($credenciamento->status == 1){
                continue;
            }
            $pendencias = array_merge($pendencias,self::checarPendenciasEndereco($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasVeiculo($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasDadosBancarios($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasPipeiro($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasPipeiroDocs($credenciamento));
            
        }
        return $pendencias;
    }

    static public function checarPendenciasEmpresa($id,$idcred = 0)
    {
        $pendencias = [];
        $empresa = Empresa_user::find($id);
        $credenciamentos = credenciamento::empresaCompleto($id,$idcred);

        foreach($credenciamentos as $credenciamento){
            if($credenciamento->status == 1){
                continue;
            }
            $pendencias = array_merge($pendencias,self::checarPendenciasdaEmpresa($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasEndereco($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasDadosBancarios($credenciamento));
            $pendencias = array_merge($pendencias,self::checarPendenciasEmpresaDocs($credenciamento));
        }
        return $pendencias;
    }

    static public function checarPendenciasEmpresa2($id,$idcred = 0)
    {
        $pendencias = [];
        $empresa = Empresa_user::find($id);

        if($idcred != 0){
            $creds = empresaCredenciamento::where(["id_empresa"=>$id,"id_credenciamento"=>$idcred])->get();
        }else{
            $creds = empresaCredenciamento::where("id_empresa",$id)->get();
        }
        foreach($creds as $c){
            $credenciamento = credenciamento::find($c->id_credenciamento);
            if($credenciamento->status == 1){
                continue;
            }
            $dadosbancarios = dadosbancarios::where('id_credenciamento', $credenciamento->id)->first();
            $endereco = endereco::where('id_credenciamento', $credenciamento->id)->first();

            if ($credenciamento != null) {

                if ($empresa != null) {
                    //02
                    if (@$empresa->doc_representante_status != 1 && @$empresa->doc_representante_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_representante',
                            'nome' => 'Documento do representante',
                            'obs' => $empresa->doc_representante_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //05
                    if (@$empresa->doc_emp_tdm_status != 1 && @$empresa->doc_emp_tdm_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_tdm',
                            'nome' => 'Declaração de trabalho de menor',
                            'obs' => $empresa->doc_emp_tdm_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //07
                    if (@$empresa->doc_emp_ccmei_status != 1 && @$empresa->doc_emp_ccmei_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_ccmei',
                            'nome' => 'Documento de Constituição da Empresa',
                            'obs' => $empresa->doc_emp_ccmei_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //08
                    if (@$empresa->doc_emp_cicnpj_status != 1 && @$empresa->doc_emp_cicnpj_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_cicnpj',
                            'nome' => 'Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ',
                            'obs' => $empresa->doc_emp_cicnpj_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //09
                    if (@$empresa->doc_emp_ciccem_status != 1 && @$empresa->doc_emp_ciccem_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_ciccem',
                            'nome' => 'Certidão de inscrição no cadastro de contribuintes estadual ou municipal, correspondente a sede do interessado',
                            'obs' => $empresa->doc_emp_ciccem_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //15
                    if (@$empresa->doc_emp_cidijt_status != 1 && @$empresa->doc_emp_cidijt_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_cidijt',
                            'nome' => 'Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho',
                            'obs' => $empresa->doc_emp_cidijt_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //17
                    if (@$empresa->doc_emp_alf_status != 1 && @$empresa->doc_emp_alf_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_alf',
                            'nome' => 'Alvará de licença de funcionamento',
                            'obs' => $empresa->doc_emp_alf_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //13
                    if (@$empresa->doc_emp_crrcss_status != 1 && @$empresa->doc_emp_crrcss_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_crrcss',
                            'nome' => 'Certidão de regularidade relativa as contribuições para a Seguridade Social',
                            'obs' => $empresa->doc_emp_crrcss_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //14
                    if (@$empresa->doc_emp_crrc_status != 1 && @$empresa->doc_emp_crrc_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_emp_crrc',
                            'nome' => 'Certidão de regularidade com referência às contribuições para o FGTS',
                            'obs' => $empresa->doc_emp_crrc_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
                if ($endereco != null) {
                    //01
                    if (@$endereco->comprovanteresidencia_status != 1 && @$endereco->comprovanteresidencia_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'comprovanteresidencia',
                            'nome' => 'Comprovante de Residência',
                            'obs' => $endereco->comprovanteresidencia_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
                //03
                if ($dadosbancarios != null) {
                    if (@$dadosbancarios->doc_comprovante_status != 1 && @$dadosbancarios->doc_comprovante_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            'id' => 'doc_comprovante',
                            'nome' => 'Comprovante de Dados Bancarios',
                            'obs' => $dadosbancarios->doc_comprovante_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
                //04
                if (@$credenciamento->doc_cico_status != 1 && @$credenciamento->doc_cico_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_cico',
                        'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações',
                        'obs' => $credenciamento->doc_cico_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //06
                if (@$credenciamento->doc_maed_status != 1 && @$credenciamento->doc_maed_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_maed',
                        'nome' => 'Modelo de autorização para exposição de dados',
                        'obs' => $credenciamento->doc_maed_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //10
                if (@$credenciamento->doc_cndf_status != 1 && @$credenciamento->doc_cndf_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_cndf',
                        'nome' => 'Certidão de regularidade com a Fazenda Federais',
                        'obs' => $credenciamento->doc_cndf_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //12
                if (@$credenciamento->doc_cndm_status != 1 && @$credenciamento->doc_cndm_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_cndm',
                        'nome' => 'Certidão de regularidade com a Fazenda Municipal',
                        'obs' => $credenciamento->doc_cndm_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //11
                if (@$credenciamento->doc_cnde_status != 1 && @$credenciamento->doc_cnde_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_cnde',
                        'nome' => 'Certidão de regularidade com a Fazenda Estadual',
                        'obs' => $credenciamento->doc_cnde_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //18
                if ($credenciamento->doc_act_status == 99) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_act',
                        'nome' => 'Atestado de Capacidade Técnica',
                        'obs' => $credenciamento->doc_act_obs
                    ];;
                    array_push($pendencias, $pendencia);
                }
                //16
                if (@$credenciamento->doc_sicaf_status != 1 && @$credenciamento->doc_sicaf_status != 2) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'doc_sicaf',
                        'nome' => 'SICAF',
                        'obs' => $credenciamento->doc_sicaf_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
        }
        return $pendencias;
    }
    //ok

    static public function checarPendenciasPipeiroEmpresa($id,$idcred = 0)
    {
        $pendencias = [];

        if($idcred != 0){
            $creds = credenciamento::pipeiroCompleto($id,$idcred);
        }else{
            $creds = credenciamento::pipeiroCompleto("id_pipeiro",$id);
        }
        // dd($creds);
        foreach($creds as $credenciamento){
            if($credenciamento->status == 1){
                continue;
            }
            $veiculo = $credenciamento->veiculo;
            $pipeiro = $credenciamento->pipeiro;

            if ($credenciamento != null) {
                if ($veiculo != null) {
                    if (@$veiculo->doc_crlv_status != 1 && @$veiculo->doc_crlv_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'doc_crlv',
                            'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                            'obs' => $veiculo->doc_crlv_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    if (@$veiculo->doc_lav_status == 99) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'doc_lav',
                            'nome' => 'Laudo de aferição de volume do tanque',
                            'obs' => $veiculo->doc_lav_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    if (@$veiculo->veiculo_img_status != 1 && @$veiculo->veiculo_img_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'veiculo_img',
                            'nome' => 'Foto do Caminhão',
                            'obs' => $veiculo->veiculo_img_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    if ($veiculo->proprio == 0) {
                        if (@$veiculo->doc_cl_status != 1 && @$veiculo->doc_cl_status != 2) {
                            $pendencia = [
                                "edital" => $credenciamento->id_edital,
                                "dono" => $pipeiro->nome,
                                'id' => 'doc_cl',
                                'nome' => 'Contrato de locação do veículo',
                                'obs' => $veiculo->doc_cl_obs
                            ];
                            array_push($pendencias, $pendencia);
                        }
                    }
                }
                if ($pipeiro != null) {
                    if (@$pipeiro->cnhfrente_status != 1 && @$pipeiro->cnhfrente_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'cnhfrente',
                            'nome' => 'Foto da CNH',
                            'obs' => $pipeiro->cnhfrente_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
                if (@$credenciamento->doc_reqcred_status != 1 && @$credenciamento->doc_reqcred_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_reqcred',
                        'nome' => 'Requerimento de Credenciamento',
                        'obs' => $credenciamento->doc_reqcred_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$credenciamento->doc_drctvc_status != 1 && @$credenciamento->doc_drctvc_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_drctvc',
                        'nome' => 'Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado',
                        'obs' => $credenciamento->doc_drctvc_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$credenciamento->doc_antt_status != 1 && @$credenciamento->doc_antt_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_antt',
                        'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                        'obs' => $credenciamento->doc_antt_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$credenciamento->doc_lvs_status != 1 && @$credenciamento->doc_lvs_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_lvs',
                        'nome' => 'Laudo da Vigilância Sanitária',
                        'obs' => $credenciamento->doc_lvs_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
        }
        return $pendencias;
    }

    static public function checarPendenciasPipeiroEmpresa2($id,$idcred = 0){
        $pendencias = [];
        $pipeiro = Pipeiro_user::find($id);

        if($idcred != 0){
            $creds = pipeiroCredenciamento::where("id_pipeiro",$id)->where("id_credenciamento",$idcred)->get();
        }else{
            $creds = pipeiroCredenciamento::where("id_pipeiro",$id)->get();
        }
        // dd($creds);
        foreach($creds as $c){
            $credenciamento = credenciamento::find($c->id_credenciamento);
            if($credenciamento->status == 1){
                continue;
            }
            $veiculo = veiculo::where('id_credenciamento', $credenciamento->id)->first();
            // $endereco = endereco::where("id_credenciamento",$credenciamento->id)->first();
            // dd($credenciamento,$veiculo,$endereco);

            if ($credenciamento != null) {
                //02
                if ($veiculo != null) {
                    if (@$veiculo->doc_crlv_status != 1 && @$veiculo->doc_crlv_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'doc_crlv',
                            'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                            'obs' => $veiculo->doc_crlv_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //03
                    if (@$veiculo->doc_lav_status == 99) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'doc_lav',
                            'nome' => 'Laudo de aferição de volume do tanque',
                            'obs' => $veiculo->doc_lav_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //04
                    if (@$veiculo->veiculo_img_status != 1 && @$veiculo->veiculo_img_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'veiculo_img',
                            'nome' => 'Foto do Caminhão',
                            'obs' => $veiculo->veiculo_img_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                    //09
                    if ($veiculo->proprio == 0) {
                        if (@$veiculo->doc_cl_status != 1 && @$veiculo->doc_cl_status != 2) {
                            $pendencia = [
                                "edital" => $credenciamento->id_edital,
                                "dono" => $pipeiro->nome,
                                'id' => 'doc_cl',
                                'nome' => 'Contrato de locação do veículo',
                                'obs' => $veiculo->doc_cl_obs
                            ];
                            array_push($pendencias, $pendencia);
                        }
                    }
                }
                if ($pipeiro != null) {
                    //01
                    if (@$pipeiro->cnhfrente_status != 1 && @$pipeiro->cnhfrente_status != 2) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'cnhfrente',
                            'nome' => 'Foto da CNH',
                            'obs' => $pipeiro->cnhfrente_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
                //05
                if (@$credenciamento->doc_reqcred_status != 1 && @$credenciamento->doc_reqcred_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_reqcred',
                        'nome' => 'Requerimento de Credenciamento',
                        'obs' => $credenciamento->doc_reqcred_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$credenciamento->doc_drctvc_status != 1 && @$credenciamento->doc_drctvc_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_drctvc',
                        'nome' => 'Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado',
                        'obs' => $credenciamento->doc_drctvc_obs
                    ];
                    array_push($pendencias, $pendencia);
                    // dd($credenciamento->doc_drctvc_status);
                }
                //07
                if (@$credenciamento->doc_antt_status != 1 && @$credenciamento->doc_antt_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_antt',
                        'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                        'obs' => $credenciamento->doc_antt_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //08
                if (@$credenciamento->doc_lvs_status != 1 && @$credenciamento->doc_lvs_status != 2) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_lvs',
                        'nome' => 'Laudo da Vigilância Sanitária',
                        'obs' => $credenciamento->doc_lvs_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
        }
        return $pendencias;
    }

    static public function AnalisarArquivos($id,$idcred){
        $pendencias = [];
        $pipeiro = Pipeiro_user::find($id);
        $credenciamento = credenciamento::where('id',$idcred)->first();
        $veiculo = veiculo::where('id_credenciamento', $credenciamento->id)->first();
        $dadosbancarios = dadosbancarios::where('id_credenciamento', $credenciamento->id)->first();
        $endereco = endereco::where('id_credenciamento', $credenciamento->id)->first();

        if ($credenciamento != null) {
            if ($endereco != null) {
                //01
                if (@$endereco->comprovanteresidencia_status != 1) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'comprovanteresidencia',
                        'nome' => 'Comprovante de Residência',
                        'obs' => $endereco->comprovanteresidencia_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if ($veiculo != null) {
                //03
                if (@$veiculo->doc_crlv_status != 1) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'doc_crlv',
                        'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                        'obs' => $veiculo->doc_crlv_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //04
                if (@$veiculo->doc_lav_status == 99 ) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'doc_lav',
                        'nome' => 'Laudo de aferição de volume do tanque',
                        'obs' => $veiculo->doc_lav_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //05
                if (@$veiculo->veiculo_img_status != 1) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'veiculo_img',
                        'nome' => 'Foto do Caminhão',
                        'obs' => $veiculo->veiculo_img_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //22
                if ($veiculo->proprio == 0) {
                    if (@$veiculo->doc_cl_status != 1) {
                        $pendencia = [
                            'edital' => $credenciamento->id_edital,
                            'id' => 'doc_cl',
                            'nome' => 'Contrato de locação do veículo',
                            'obs' => $veiculo->doc_cl_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
            }
            if ($dadosbancarios != null) {
                //06
                if (@$dadosbancarios->doc_comprovante_status != 1) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'doc_comprovante',
                        'nome' => 'Comprovante de Dados Bancarios',
                        'obs' => $dadosbancarios->doc_comprovante_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if ($pipeiro != null) {
                //02
                if (@$pipeiro->cnhfrente_status != 1) {
                    $pendencia = [
                        'edital' => $credenciamento->id_edital,
                        'id' => 'cnhfrente',
                        'nome' => 'Foto da CNH',
                        'obs' => $pipeiro->cnhfrente_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //13
                if (@$pipeiro->genero == 1) {
                    if ($credenciamento->doc_cqsm_status != 1) {
                        $pendencia = [
                            'edital' => $credenciamento->id_edital,
                            'id' => 'doc_cqsm',
                            'nome' => 'Certidão de Quitação com o Serviço Militar (para o sexo masculino)',
                            'obs' => $credenciamento->doc_cqsm_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
            }
            //07
            if (@$credenciamento->doc_reqcred_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_reqcred',
                    'nome' => 'Requerimento de Credenciamento',
                    'obs' => $credenciamento->doc_reqcred_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //08
            if (@$credenciamento->doc_cico_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cico',
                    'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações',
                    'obs' => $credenciamento->doc_cico_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //09
            if (@$credenciamento->doc_drctvc_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_drctvc',
                    'nome' => 'Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado',
                    'obs' => $credenciamento->doc_drctvc_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //11
            if (@$credenciamento->doc_cicips_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cicips',
                    'nome' => 'Comprovante de Inscrição como Contribuinte Individual da Previdência Social',
                    'obs' => $credenciamento->doc_cicips_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //12
            if (@$credenciamento->doc_cqe_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cqe',
                    'nome' => 'Certidão de Quitação Eleitoral',
                    'obs' => $credenciamento->doc_cqe_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //10
            if (@$credenciamento->doc_maed_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_maed',
                    'nome' => 'Modelo de autorização para exposição de dados',
                    'obs' => $credenciamento->doc_maed_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //14
            if (@$credenciamento->doc_sicaf_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_sicaf',
                    'nome' => 'SICAF',
                    'obs' => $credenciamento->doc_sicaf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //15
            if (@$credenciamento->doc_ciscc_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_ciscc',
                    'nome' => 'Comprovante de situação cadastral no CPF',
                    'obs' => $credenciamento->doc_ciscc_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //16
            if (@$credenciamento->doc_cndf_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cndf',
                    'nome' => 'Certidão de Regularidade para com a Fazenda Federal',
                    'obs' => $credenciamento->doc_cndf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //17
            if (@$credenciamento->doc_cnde_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cnde',
                    'nome' => 'Certidão de Regularidade para com a Fazenda Estadual',
                    'obs' => $credenciamento->doc_cnde_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //18
            if (@$credenciamento->doc_cndm_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cndm',
                    'nome' => 'Certidão Negativa de Débitos Municipais',
                    'obs' => $credenciamento->doc_cndm_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //19
            if (@$credenciamento->doc_cidt_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_cidt',
                    'nome' => 'Certidão de Inexistência de Débitos Trabalhistas',
                    'obs' => $credenciamento->doc_cidt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //20
            if (@$credenciamento->doc_antt_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_antt',
                    'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                    'obs' => $credenciamento->doc_antt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //21
            if (@$credenciamento->doc_lvs_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_lvs',
                    'nome' => 'Laudo da Vigilância Sanitária',
                    'obs' => $credenciamento->doc_lvs_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //23
            if (@$credenciamento->doc_act_status == 99) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_act',
                    'nome' => 'Atestado de capacidade técnica',
                    'obs' => $credenciamento->doc_act_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        return $pendencias;
    }

    static public function AnalisarArquivosEmpresa($id,$idcred = 0){

        $pendencias = [];
        $empresa = Empresa_user::find($id);
        $credenciamento = credenciamento::find($idcred);
        $dadosbancarios = dadosbancarios::where('id_credenciamento', $credenciamento->id)->first();
        $endereco = endereco::where('id_credenciamento', $credenciamento->id)->first();

        if ($credenciamento != null) {

            if ($empresa != null) {
                if (@$empresa->doc_representante_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_representante',
                        'nome' => 'Documento do representante',
                        'obs' => $empresa->doc_representante_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_tdm_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_tdm',
                        'nome' => 'Declaração de trabalho de menor',
                        'obs' => $empresa->doc_emp_tdm_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_ccmei_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_ccmei',
                        'nome' => 'Documento de Constituição da Empresa',
                        'obs' => $empresa->doc_emp_ccmei_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_cicnpj_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_cicnpj',
                        'nome' => 'Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ',
                        'obs' => $empresa->doc_emp_cicnpj_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_ciccem_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_ciccem',
                        'nome' => 'Certidão de inscrição no cadastro de contribuintes estadual ou municipal, correspondente a sede do interessado',
                        'obs' => $empresa->doc_emp_ciccem_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_cidijt_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_cidijt',
                        'nome' => 'Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho',
                        'obs' => $empresa->doc_emp_cidijt_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_alf_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_alf',
                        'nome' => 'Certidão de regularidade relativa as contribuições para a Seguridade Social',
                        'obs' => $empresa->doc_emp_alf_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_crrcss_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_crrcss',
                        'nome' => 'Certidão de regularidade relativa as contribuições para a Seguridade Social',
                        'obs' => $empresa->doc_emp_crrcss_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_crrc_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_emp_crrc',
                        'nome' => 'Certidão de regularidade com referência às contribuições para o FGTS',
                        'obs' => $empresa->doc_emp_crrc_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if ($endereco != null) {
                if (@$endereco->comprovanteresidencia_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'comprovanteresidencia',
                        'nome' => 'Comprovante de Residência',
                        'obs' => $endereco->comprovanteresidencia_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if ($dadosbancarios != null) {
                if (@$dadosbancarios->doc_comprovante_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        'id' => 'doc_comprovante',
                        'nome' => 'Comprovante de Dados Bancarios',
                        'obs' => $dadosbancarios->doc_comprovante_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if (@$credenciamento->doc_cico_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_cico',
                    'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações',
                    'obs' => $credenciamento->doc_cico_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_maed_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_maed',
                    'nome' => 'Modelo de autorização para exposição de dados',
                    'obs' => $credenciamento->doc_maed_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cndf_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_cndf',
                    'nome' => 'Certidão de regularidade com a Fazenda Federais',
                    'obs' => $credenciamento->doc_cndf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cndm_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_cndm',
                    'nome' => 'Certidão de regularidade com a Fazenda Municipal',
                    'obs' => $credenciamento->doc_cndm_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cnde_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    'id' => 'doc_cnde',
                    'nome' => 'Certidão de regularidade com a Fazenda Estadual',
                    'obs' => $credenciamento->doc_cnde_obs
                ];
                array_push($pendencias, $pendencia);
            }
            // if ($credenciamento->doc_act_status != 1) {
            //     $pendencia = [
            //         "edital" => $credenciamento->id_edital,
            //         'id' => 'doc_act',
            //         'nome' => 'Atestado de Capacidade Técnica',
            //         'obs' => $credenciamento->doc_act_obs
            //     ];;
            //     array_push($pendencias, $pendencia);
            // }
            if (@$credenciamento->doc_sicaf_status != 1) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_sicaf',
                    'nome' => 'SICAF',
                    'obs' => $credenciamento->doc_sicaf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //18
            if (@$credenciamento->doc_act_status == 99) {
                $pendencia = [
                    'edital' => $credenciamento->id_edital,
                    'id' => 'doc_act',
                    'nome' => 'Atestado de capacidade técnica',
                    'obs' => $credenciamento->doc_act_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        // dd($pendencias);
        return $pendencias;
    }

    static public function AnalisarArquivosMot($id,$idcred = 0){
        $pendencias = [];
        $pipeiro = Pipeiro_user::find($id);

        $credenciamento = credenciamento::find($idcred);
        $veiculo = veiculo::where('id_credenciamento', $credenciamento->id)->first();
        $endereco = endereco::where("id_credenciamento",$credenciamento->id)->first();
        // dd($credenciamento,$veiculo,$endereco);

        if ($credenciamento != null) {
            //02
            if ($veiculo != null) {
                if (@$veiculo->doc_crlv_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_crlv',
                        'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                        'obs' => $veiculo->doc_crlv_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //03
                if (@$veiculo->doc_lav_status == 99) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_lav',
                        'nome' => 'Laudo de aferição de volume do tanque',
                        'obs' => $veiculo->doc_lav_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //04
                if (@$veiculo->veiculo_img_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'veiculo_img',
                        'nome' => 'Foto do Caminhão',
                        'obs' => $veiculo->veiculo_img_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                //09
                if ($veiculo->proprio == 0) {
                    if (@$veiculo->doc_cl_status != 1) {
                        $pendencia = [
                            "edital" => $credenciamento->id_edital,
                            "dono" => $pipeiro->nome,
                            'id' => 'doc_cl',
                            'nome' => 'Contrato de locação do veículo',
                            'obs' => $veiculo->doc_cl_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
            }
            if ($pipeiro != null) {
                //01
                if (@$pipeiro->cnhfrente_status != 1) {
                    $pendencia = [
                        "edital" => $credenciamento->id_edital,
                        "dono" => $pipeiro->nome,
                        'id' => 'cnhfrente',
                        'nome' => 'Foto da CNH',
                        'obs' => $pipeiro->cnhfrente_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            //05
            if (@$credenciamento->doc_reqcred_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_reqcred',
                    'nome' => 'Requerimento de Credenciamento',
                    'obs' => $credenciamento->doc_reqcred_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //06
            if (@$credenciamento->doc_drctvc_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_drctvc',
                    'nome' => 'Termo de declaração e responsabilidade das condições de trafegabilidade do veículo a ser credenciado',
                    'obs' => $credenciamento->doc_drctvc_obs
                ];
                array_push($pendencias, $pendencia);
                // dd(@$credenciamento->doc_drctvc_status);
            }
            //07
            if (@$credenciamento->doc_antt_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_antt',
                    'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                    'obs' => $credenciamento->doc_antt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            //08
            if (@$credenciamento->doc_lvs_status != 1) {
                $pendencia = [
                    "edital" => $credenciamento->id_edital,
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_lvs',
                    'nome' => 'Laudo da Vigilância Sanitária',
                    'obs' => $credenciamento->doc_lvs_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        
        return $pendencias;
    }

    static public function pendenciasMotorista($id){
        $todaspendencias = [];
        $motoristas = Pipeiro_user::where('id_empresa', $id)->get();
        foreach ($motoristas as $mot) {
            array_push($todaspendencias, CredenciamentoController::checarPendenciasPipeiroEmpresa($mot->id));
        }
        return $todaspendencias;
    }

    public function resetarsenha(Request $request){
        //TIPO: 1 - pipeiro, 2 - empresa
        // $cred = credenciamento::finds($request->id);
        if($request->tipo == 1){
            $pipeiro = Pipeiro_user::find($request->id);
            $doc = $pipeiro->cpf;
            $doc = str_replace(array('.','-'),'',$doc);
            $pipeiro->password = bcrypt($doc);
            $pipeiro->mudasenha = 1;
            $pipeiro->save();
        }else if($request->tipo == 2){
            $empresa = Empresa_user::find($request->id);
            $doc = $empresa->cnpj;
            $doc = str_replace(array('.','-','/'),'',$doc);
            $empresa->password = bcrypt($doc);
            $empresa->mudasenha = 1;
            $empresa->save();
        }
    }

    public function descredenciar(Request $request){
        try{
            $id = $request->id;
            $credenciamento = credenciamento::find($id);
            $credenciamento->status = 90;
            $credenciamento->save();

            return response()->json(['success' => 'descredenciado'], 200);
        }catch(\Exception $e){
            return response()->json(['error' => 'Erro ao descredenciar: ' . $e->getMessage()], 500);
        }
        
    }

    public function enviarCredenciamento(Request $request){
        $erros= [];
        $id_pipeiro = Auth::guard('pipeiro')->user()->id;
        $id_credenciamento = $request->id;
        $pendencias = $this->checarPendencias($id_pipeiro,$id_credenciamento);

        $pipeiro = Pipeiro_user::find($id_pipeiro);
        $credenciamento = credenciamento::where('id',$id_credenciamento)->first();
        // dd($id_pipeiro,$pipeiro,$id_credenciamento,$credenciamento);
        $dadosbancarios = Dadosbancarios::where('id_credenciamento',$id_credenciamento)->first();
        $veiculos = veiculo::where('id_credenciamento',$id_credenciamento)->first();
        $endereco = endereco::where('id_credenciamento',$id_credenciamento)->first();
        //começa a verificar os campos do pipeiro
        if($pipeiro->cpf == "" || $pipeiro->cpf === null){
            array_push($erros,"CPF");
        }
        if($pipeiro->nome == "" || $pipeiro->nome === null){
            array_push($erros,"nome");
        }
        if($pipeiro->email == "" || $pipeiro->email === null){
            array_push($erros,"email");
        }
        if($pipeiro->escolaridade == "" || $pipeiro->escolaridade === null){
            array_push($erros,"escolaridade");
        }
        if($pipeiro->estadocivil == "" || $pipeiro->estadocivil === null){
            array_push($erros,"estado civil");
        }
        if($pipeiro->cnhnumero == "" || $pipeiro->cnhnumero === null){
            array_push($erros,"numero da cnh");
        }
        if($pipeiro->cnhcateg == "" || $pipeiro->cnhcateg === null){
            array_push($erros,"categoria da cnh");
        }
        if($pipeiro->cnhdata == "" || $pipeiro->cnhdata === null){
            array_push($erros,"data de vencimento da cnh");
        }
        if($pipeiro->telefone == "" || $pipeiro->telefone === null){
            array_push($erros,"telefone");
        }
        if($pipeiro->dtnascimento == "" || $pipeiro->dtnascimento === null){
            array_push($erros,"data de nascimento");
        }
        if($pipeiro->raca == "" || $pipeiro->raca === null){
            array_push($erros,"etnia");
        }
        if($pipeiro->genero == "" || $pipeiro->genero === null){
            array_push($erros,"genero");
        }
        //valida o credenciamento
        if($credenciamento->id_estado == "" || $credenciamento->id_estado === null){
            array_push($erros,"estado");
        }
        if($credenciamento->id_municipio == "" || $credenciamento->id_municipio === null){
            array_push($erros,"municipio");
        }
        //valida os dados bancarios
        if($dadosbancarios->banco == "" || $dadosbancarios->banco === null){
            array_push($erros,"banco");
        }
        if($dadosbancarios->agencia == "" || $dadosbancarios->agencia === null){
            array_push($erros,"agencia");
        }
        if($dadosbancarios->conta == "" || $dadosbancarios->conta === null){
            array_push($erros,"conta");
        }
        //valida dados do veiculo
        if($veiculos->placa == "" || $veiculos->placa === null){
            array_push($erros,"placa");
        }
        if($veiculos->marca == "" || $veiculos->marca === null){
            array_push($erros,"marca/modelo");
        }
        // if($veiculos->modelo == "" || $veiculos->modelo === null){
        //     array_push($erros,"modelo");
        // }
        if($veiculos->ano == "" || $veiculos->ano === null){
            array_push($erros,"ano");
        }
        if($veiculos->chassi == "" || $veiculos->chassi === null){
            array_push($erros,"chassi");
        }
        //validar dados do endereco
        if($endereco->cep == "" || $endereco->cep === null){
            array_push($erros,"cep");
        }
        if($endereco->logradouro == "" || $endereco->logradouro === null){
            array_push($erros,"logradouro");
        }
        if($endereco->bairro == "" || $endereco->bairro === null){
            array_push($erros,"bairro");
        }
        if($endereco->cidade == "" || $endereco->cidade === null){
            array_push($erros,"cidade");
        }
        if($endereco->estado == "" || $endereco->estado === null){
            array_push($erros,"estado");
        }
        if($endereco->numero == "" || $endereco->numero === null){
            array_push($erros,"numero");
        }
        
        foreach($pendencias as $p){
            array_push($erros,$p['nome']);
        }
        
        if(count($erros)>0){
            $credenciamento->status = 99;
            $credenciamento->save();
            return $erros;
        }
        else{
            //se o status tiver em branco, manda pra analise
            //se o status tiver em correção, manda pra corrigido
            if($credenciamento->status == 2){
                $credenciamento->status = 4;
            }else{
                $credenciamento->status = 3;
                $credenciamento->data_envio = Carbon::now();
            }
            $credenciamento->save();
            // dd($credenciamento);
        }
        
    }

    public function enviarCredenciamentoMotorista(Request $request){
        $erros= [];
        $id_pipeiro = $request->id;
        $id_credenciamento = $request->credenciamento;
        // dd($id_pipeiro,$id_credenciamento);
        $pendencias = $this->checarPendenciasPipeiroEmpresa($id_pipeiro,$id_credenciamento);
        $pipeiro = Pipeiro_user::find($id_pipeiro);
        $credenciamento = credenciamento::where('id',$id_credenciamento)->first();
        // dd($id_pipeiro,$pipeiro,$id_credenciamento,$credenciamento);
        // $dadosbancarios = Dadosbancarios::where('id_credenciamento',$id_credenciamento)->first();
        $veiculos = veiculo::where('id_credenciamento',$id_credenciamento)->first();
        // dd($credenciamento,$veiculos);
        // $endereco = endereco::where('id_credenciamento',$id_credenciamento)->first();
        //começa a verificar os campos do pipeiro
        if($pipeiro->cpf == "" || $pipeiro->cpf === null){
            array_push($erros,"CPF");
        }
        if($pipeiro->nome == "" || $pipeiro->nome === null){
            array_push($erros,"nome");
        }
        if($pipeiro->email == "" || $pipeiro->email === null){
            array_push($erros,"email");
        }
        if($pipeiro->escolaridade == "" || $pipeiro->escolaridade === null){
            array_push($erros,"escolaridade");
        }
        if($pipeiro->estadocivil == "" || $pipeiro->estadocivil === null){
            array_push($erros,"estado civil");
        }
        if($pipeiro->cnhnumero == "" || $pipeiro->cnhnumero === null){
            array_push($erros,"numero da cnh");
        }
        if($pipeiro->cnhcateg == "" || $pipeiro->cnhcateg === null){
            array_push($erros,"categoria da cnh");
        }
        if($pipeiro->cnhdata == "" || $pipeiro->cnhdata === null){
            array_push($erros,"data de vencimento da cnh");
        }
        if($pipeiro->telefone == "" || $pipeiro->telefone === null){
            array_push($erros,"telefone");
        }
        if($pipeiro->dtnascimento == "" || $pipeiro->dtnascimento === null){
            array_push($erros,"data de nascimento");
        }
        if($pipeiro->raca == "" || $pipeiro->raca === null){
            array_push($erros,"etnia");
        }
      
        if($pipeiro->genero == "" || $pipeiro->genero === null){
            array_push($erros,"genero");
        }

        //valida o credenciamento
        if($credenciamento->id_estado == "" || $credenciamento->id_estado === null){
            array_push($erros,"estado");
        }
        if($credenciamento->id_municipio == "" || $credenciamento->id_municipio === null){
            array_push($erros,"municipio");
        }

        // //valida os dados bancarios
        // if($dadosbancarios->banco == "" || $dadosbancarios->banco === null){
        //     array_push($erros,"banco");
        // }
        // if($dadosbancarios->agencia == "" || $dadosbancarios->agencia === null){
        //     array_push($erros,"agencia");
        // }
        // if($dadosbancarios->conta == "" || $dadosbancarios->conta === null){
        //     array_push($erros,"conta");
        // }

        //valida dados do veiculo
        if($veiculos->placa == "" || $veiculos->placa === null){
            array_push($erros,"placa");
        }
        if($veiculos->marca == "" || $veiculos->marca === null){
            array_push($erros,"marca/modelo");
        }
        // if($veiculos->modelo == "" || $veiculos->modelo === null){
        //     array_push($erros,"modelo");
        // }
        if($veiculos->ano == "" || $veiculos->ano === null){
            array_push($erros,"ano");
        }
        if($veiculos->chassi == "" || $veiculos->chassi === null){
            array_push($erros,"chassi");
        }

        //validar dados do endereco
        // if($endereco->cep == "" || $endereco->cep === null){
        //     array_push($erros,"cep");
        // }
        // if($endereco->logradouro == "" || $endereco->logradouro === null){
        //     array_push($erros,"logradouro");
        // }
        // if($endereco->bairro == "" || $endereco->bairro === null){
        //     array_push($erros,"bairro");
        // }
        // if($endereco->cidade == "" || $endereco->cidade === null){
        //     array_push($erros,"cidade");
        // }
        // if($endereco->estado == "" || $endereco->estado === null){
        //     array_push($erros,"estado");
        // }
        // if($endereco->numero == "" || $endereco->numero === null){
        //     array_push($erros,"numero");
        // }
        
        foreach($pendencias as $p){
            array_push($erros,$p['nome']);
        }

        // dd(count($erros));
        
        if(count($erros)>0){
            $credenciamento->status = 99;
            $credenciamento->save();
            return $erros;
        }
        else{
            //se o status tiver em branco, manda pra analise
            //se o status tiver em correção, manda pra corrigido
            if($credenciamento->status == 2){
                $credenciamento->status = 4;
            }else{
                $credenciamento->status = 3;
                $credenciamento->data_envio = Carbon::now();
            }
            // dd($credenciamento);
            $credenciamento->save();
            
            // dd($credenciamento);
        }
        
    }

    public function enviarCredenciamentoEmpresa(Request $request){
        $erros= [];
        
        $id_empresa = Auth::guard('empresa')->user()->id;
        $id_credenciamento = $request->id;
        $pendencias = $this->checarPendenciasEmpresa($id_empresa,$id_credenciamento);

        $empresa = Empresa_user::find($id_empresa);
        $credenciamento = credenciamento::where('id',$id_credenciamento)->first();
        $dadosbancarios = Dadosbancarios::where('id_credenciamento',$id_credenciamento)->first();
        $endereco = endereco::where('id_credenciamento',$id_credenciamento)->first();
        //começa a verificar os campos do pipeiro
        if($empresa->cnpj == "" || $empresa->cnpj === null){
            array_push($erros,"cnpj");
        }
        if($empresa->nome == "" || $empresa->nome === null){
            array_push($erros,"nome");
        }
        if($empresa->razaosocial == "" || $empresa->razaosocial === null){
            array_push($erros,"Razão Social");
        }
        if($empresa->email == "" || $empresa->email === null){
            array_push($erros,"email");
        }
        if($empresa->telefone == "" || $empresa->telefone === null){
            array_push($erros,"telefone");
        }
        if($empresa->nome_representante == "" || $empresa->nome_representante === null){
            array_push($erros,"nome_representante");
        }
        if($empresa->telefone_representante == "" || $empresa->telefone_representante === null){
            array_push($erros,"telefone_representante");
        }

        //valida os dados bancarios
        if($dadosbancarios->banco == "" || $dadosbancarios->banco === null){
            array_push($erros,"banco");
        }
        if($dadosbancarios->agencia == "" || $dadosbancarios->agencia === null){
            array_push($erros,"agencia");
        }
        if($dadosbancarios->conta == "" || $dadosbancarios->conta === null){
            array_push($erros,"conta");
        }

        //validar dados do endereco
        if($endereco->cep == "" || $endereco->cep === null){
            array_push($erros,"cep");
        }
        if($endereco->logradouro == "" || $endereco->logradouro === null){
            array_push($erros,"logradouro");
        }
        if($endereco->bairro == "" || $endereco->bairro === null){
            array_push($erros,"bairro");
        }
        if($endereco->cidade == "" || $endereco->cidade === null){
            array_push($erros,"cidade");
        }
        if($endereco->estado == "" || $endereco->estado === null){
            array_push($erros,"estado");
        }
        if($endereco->numero == "" || $endereco->numero === null){
            array_push($erros,"numero");
        }
        
        foreach($pendencias as $p){
            array_push($erros,$p['nome']);
        }
        
        if(count($erros)>0){
            $credenciamento->status = 99;
            $credenciamento->save();
            return $erros;
        }
        else{
            //se o status tiver em branco, manda pra analise
            //se o status tiver em correção, manda pra corrigido
            if($credenciamento->status == 2){
                $credenciamento->status = 4;
            }else{
                $credenciamento->status = 3;
                $credenciamento->data_envio = Carbon::now();
            }
            $credenciamento->save();
            // dd($credenciamento);
        }
        
    }

    public static function checarCredenciamento($id_pipeiro,$id_credenciamento){
        $erros= [];
        $pipeiro = Pipeiro_user::find($id_pipeiro);
        $credenciamento = credenciamento::where('id',$id_credenciamento)->first();
        // $credenciamento2 = credenciamento::find($id_credenciamento)->get();
        
        if($credenciamento->id_empresa != "" && $credenciamento->id_empresa != null){
            $pendencias = CredenciamentoController::checarPendenciasPipeiroEmpresa($id_pipeiro,$id_credenciamento);
        }else{
            $pendencias = CredenciamentoController::checarPendencias($id_pipeiro,$id_credenciamento);
            $dadosbancarios = Dadosbancarios::where('id_credenciamento',$id_credenciamento)->first();
            $endereco = endereco::where('id_credenciamento',$id_credenciamento)->first();
        }
        
        $veiculos = veiculo::where('id_credenciamento',$id_credenciamento)->first();

        //começa a verificar os campos do pipeiro
        if($pipeiro->cpf == "" || $pipeiro->cpf === null){
            array_push($erros,"CPF");
        }
        if($pipeiro->nome == "" || $pipeiro->nome === null){
            array_push($erros,"nome");
        }
        if($pipeiro->email == "" || $pipeiro->email === null){
            array_push($erros,"email");
        }
        if($pipeiro->escolaridade == "" || $pipeiro->escolaridade === null){
            array_push($erros,"escolaridade");
        }
        if($pipeiro->estadocivil == "" || $pipeiro->estadocivil === null){
            array_push($erros,"estado civil");
        }
        if($pipeiro->cnhnumero == "" || $pipeiro->cnhnumero === null){
            array_push($erros,"numero da cnh");
        }
        if($pipeiro->cnhcateg == "" || $pipeiro->cnhcateg === null){
            array_push($erros,"categoria da cnh");
        }
        if($pipeiro->cnhdata == "" || $pipeiro->cnhdata === null){
            array_push($erros,"data de vencimento da cnh");
        }
        if($pipeiro->telefone == "" || $pipeiro->telefone === null){
            array_push($erros,"telefone");
        }
        if($pipeiro->dtnascimento == "" || $pipeiro->dtnascimento === null){
            array_push($erros,"data de nascimento");
        }
        if($pipeiro->raca == "" || $pipeiro->raca === null){
            array_push($erros,"etnia");
        }
        if($pipeiro->genero == "" || $pipeiro->genero === null){
            array_push($erros,"genero");
        }

        if($credenciamento->id_estado == "" || $credenciamento->id_estado === null){
            array_push($erros,"estado");
        }
        if($credenciamento->id_municipio == "" || $credenciamento->id_municipio === null){
            array_push($erros,"municipio");
        }

        if($veiculos->placa == "" || $veiculos->placa === null){
            array_push($erros,"placa");
        }
        if($veiculos->marca == "" || $veiculos->marca === null){
            array_push($erros,"marca/modelo");
        }
        if($veiculos->ano == "" || $veiculos->ano === null){
            array_push($erros,"ano");
        }
        if($veiculos->chassi == "" || $veiculos->chassi === null){
            array_push($erros,"chassi");
        }

        if($credenciamento->id_empresa == "" || $credenciamento->id_empresa == null){

            //valida os dados bancarios
            if($dadosbancarios->banco == "" || $dadosbancarios->banco === null){
                array_push($erros,"banco");
            }
            if($dadosbancarios->agencia == "" || $dadosbancarios->agencia === null){
                array_push($erros,"agencia");
            }
            if($dadosbancarios->conta == "" || $dadosbancarios->conta === null){
                array_push($erros,"conta");
            }

            //validar dados do endereco
            if($endereco->cep == "" || $endereco->cep === null){
                array_push($erros,"cep");
            }
            if($endereco->logradouro == "" || $endereco->logradouro === null){
                array_push($erros,"logradouro");
            }
            if($endereco->bairro == "" || $endereco->bairro === null){
                array_push($erros,"bairro");
            }
            if($endereco->cidade == "" || $endereco->cidade === null){
                array_push($erros,"cidade");
            }
            if($endereco->estado == "" || $endereco->estado === null){
                array_push($erros,"estado");
            }
            if($endereco->numero == "" || $endereco->numero === null){
                array_push($erros,"numero");
            }

        }
        
        foreach($pendencias as $p){
            array_push($erros,$p['nome']);
        }

        if(count($erros)>0){
            if($credenciamento->status != 2){
                $credenciamento->status = 99;
            }
        }
        else{
            if($credenciamento->status == 2){
                $credenciamento->status = 4;
            }else{
                $credenciamento->status = 98;
            }
        }
        $credenciamento->save();  
        return $erros;
        
    }

    public static function checarCredenciamentoEmpresa($id_empresa,$id_credenciamento){
        $erros= [];
        // dd($id_empresa,$id_credenciamento);
        $pendencias = CredenciamentoController::checarPendenciasEmpresa($id_empresa,$id_credenciamento);

        $empresa = Empresa_user::find($id_empresa);
        $credenciamento = credenciamento::where('id',$id_credenciamento)->first();
        $dadosbancarios = Dadosbancarios::where('id_credenciamento',$id_credenciamento)->first();
        $endereco = endereco::where('id_credenciamento',$id_credenciamento)->first();
        //começa a verificar os campos do pipeiro
        if($empresa->cnpj == "" || $empresa->cnpj === null){
            array_push($erros,"cnpj");
        }
        if($empresa->nome == "" || $empresa->nome === null){
            array_push($erros,"nome");
        }
        if($empresa->razaosocial == "" || $empresa->razaosocial === null){
            array_push($erros,"Razão Social");
        }
        if($empresa->email == "" || $empresa->email === null){
            array_push($erros,"email");
        }
        if($empresa->telefone == "" || $empresa->telefone === null){
            array_push($erros,"telefone");
        }
        if($empresa->nome_representante == "" || $empresa->nome_representante === null){
            array_push($erros,"nome_representante");
        }
        if($empresa->telefone_representante == "" || $empresa->telefone_representante === null){
            array_push($erros,"telefone_representante");
        }
        
        //valida os dados bancarios
        if($dadosbancarios->banco == "" || $dadosbancarios->banco === null){
            array_push($erros,"banco");
        }
        if($dadosbancarios->agencia == "" || $dadosbancarios->agencia === null){
            array_push($erros,"agencia");
        }
        if($dadosbancarios->conta == "" || $dadosbancarios->conta === null){
            array_push($erros,"conta");
        }

        //validar dados do endereco
        if($endereco->cep == "" || $endereco->cep === null){
            array_push($erros,"cep");
        }
        if($endereco->logradouro == "" || $endereco->logradouro === null){
            array_push($erros,"logradouro");
        }
        if($endereco->bairro == "" || $endereco->bairro === null){
            array_push($erros,"bairro");
        }
        if($endereco->cidade == "" || $endereco->cidade === null){
            array_push($erros,"cidade");
        }
        if($endereco->estado == "" || $endereco->estado === null){
            array_push($erros,"estado");
        }
        if($endereco->numero == "" || $endereco->numero === null){
            array_push($erros,"numero");
        }
        
        foreach($pendencias as $p){
            array_push($erros,$p['nome']);
        }
        if(count($erros)>0){
            if($credenciamento->status == 2){
            }else{
                $credenciamento->status = 99;
            }
        }
        else{
            //se o status tiver em branco, manda pra analise
            //se o status tiver em correção, manda pra corrigido
            if($credenciamento->status == 2){
                $credenciamento->status = 4;
            }else{
                $credenciamento->status = 98;
            }
            // dd($credenciamento);
        }
        // dd("aqui",$credenciamento->status);
        $credenciamento->save();  
        // dd($credenciamento);
        return $erros;
        
    }

    public function deletarCredenciamento(Request $request){
        $id = $request->id;
        $id_pipeiro = Auth::guard('pipeiro')->user()->id;
        $credsPipeiro = pipeiroCredenciamento::where(['id_pipeiro'=>$id_pipeiro,'id_credenciamento'=>$id])->first();
        $cred = credenciamento::where(['id_pipeiro'=>$id_pipeiro,'id'=>$id])->first();
        // dd($cred,$credsPipeiro);
        $credsPipeiro->delete();
        $cred->delete();
        return redirect()->route("pipeiro.credenciamentos");
    }

    public function deletarCredenciamentoEmpresa(Request $request){
        $id = $request->id;
        $id_empresa = Auth::guard('empresa')->user()->id;
        $credsEmpresa = empresaCredenciamento::where(['id_empresa'=>$id_empresa,'id_credenciamento'=>$id])->first();
        $cred = credenciamento::where(['id_empresa'=>$id_empresa,'id'=>$id])->first();
        $credsEmpresa->delete();
        $cred->delete();
        return redirect()->route("pipeiro.credenciamentos");
    }

    public static function credStatus($status){
        $resp ="";
        if($status == 1){
            $resp = "Documentação Aprovada";
        }else if($status == 2){
            $resp = "Em Correção";
        }else if($status == 3){
            $resp = "Para Análise";
        }else if($status == 4){
            $resp = "Corrigido";
        }else if($status == 98){
            $resp = "Aguardando Envio";
        }else if($status == 99){
            $resp = "Incompleto";
        }else if($status == 90){
            $resp = "Descredenciado";
        }
        return $resp;
    }

    public static function salvarArquivo($request, &$object, $arquivo, $chave, $pasta,$edital = null){
        
        if ($request->hasFile($arquivo)) {
            $file = $request->file($arquivo);
            if ($object[$arquivo] && Storage::exists($object[$arquivo])) {
                Storage::delete($object[$arquivo]);
            }
            $extension = strtolower($file->getClientOriginalExtension());
            if ($extension === 'pdf') {             
                if($file->getSize() > 5242880){
                    $object[$arquivo] = "";
                    $object[$arquivo . "_status"] = "99";
                    $object[$arquivo . "_obs"] = "O arquivo é maior que 5mb";
                }else{
                    $edital->nome = str_replace(" ","",$edital->nome);
                    $pastaEdital = $edital->id . $edital->nome;
                    $caracteres_para_remover = array(".", ",", "-", "/");
                    $chave = str_replace($caracteres_para_remover, "", $chave);
                    $caminho = $file->store($pastaEdital . '/' . $chave . '/' . $pasta);
                    // if($arquivo == "doc_maed"){
                    //     $tipoMime = mime_content_type($file->getPathname());
                    //     dd($tipoMime);
                    //     $nomeOriginal = $file->getClientOriginalName();
                    //     dd($nomeOriginal);
                    //     $file = $request->file($arquivo);
                    //     dd($file->getMimeType());
                    //     $extension = strtolower($file->getClientOriginalExtension());
                    //     dd($extension);
                    // }
                    $object[$arquivo] = $caminho;
                    $object[$arquivo . "_status"] = "2";
                    $object[$arquivo . "_obs"] = "";
                }
                
            } else {
                $object[$arquivo] = "";
                $object[$arquivo . "_status"] = "99";
                $object[$arquivo . "_obs"] = "O arquivo não era um PDF";
            }
        }
    }

    public static function deletarArquivo(Request $request){
        // dd($request->all());
        switch ($request->tipo) {
            case "credenciamento":
                $class = credenciamento::find($request->id);
                break;
            case "endereco":
                $class = endereco::find($request->id);
                break;
            case "dadosbancarios":
                $class = dadosbancarios::find($request->id);
                break;
            case "pipeiro":
                $class = Pipeiro_user::find(auth('pipeiro')->user()->id);
                break;
            case "veiculo":
                $class = veiculo::find($request->id);
                break;
            case "empresa":
                $class = Empresa_user::find(auth('empresa')->user()->id);
                break;
        }
        if (Storage::exists($class["$request->arquivo"])) {
            Storage::delete($class["$request->arquivo"]);
        }
        $class["$request->arquivo"] = "";
        $class["$request->arquivo" . "_status"] = "99";
        $class["$request->arquivo" . "_obs"] = "";
        $class->save();
    }

    public static function getCredenciamentos($tipo,$idmotorista = 0){
        if($tipo == "pipeiro"){
            $id = Auth::guard('pipeiro')->user()->id;
            $creds = credenciamento::pipeiroCompleto($id);
        }else if($tipo == "motorista"){
            $creds = credenciamento::pipeiroCompleto($idmotorista);
        }else{
            $id = Auth::guard('empresa')->user()->id;
            
            $creds = credenciamento::empresaCompleto($id);
        }
        foreach($creds as $c){
            $c->status = self::credStatus($c->status);
        }
        return $creds;
    }

    public static function quantidadeFisica(){
        $edital = Edital::where('id_om',Auth::guard('operador')->user()->id_om)->first();
        $count = credenciamento::selectRaw("count(*) as qtd, status")
        ->where(function($query) {
            $query->whereNull('id_empresa')
                ->orWhere('id_empresa', '=', '');
        })
        ->where('id_edital',@$edital->id)
        ->groupBy('status')
        ->get();
        return $count;
    }

    public static function quantidadeJuridica(){
        $edital = Edital::where('id_om',Auth::guard('operador')->user()->id_om)->first();
        $count = credenciamento::selectRaw("count(*) as qtd, status")
        ->where(function($query) {
            $query->whereNull('id_pipeiro')
                ->orWhere('id_pipeiro', '=', '');
        })
        ->where('id_edital',@$edital->id)
        ->groupBy('status')
        ->get();
        return $count;
    }

    public static function quantidadeMotoristas(){
        $edital = Edital::where('id_om',Auth::guard('operador')->user()->id_om)->first();
        $count = credenciamento::selectRaw("count(*) as qtd, status")
        ->where(function($query) {
            $query->whereNotNull('id_empresa')
                ->where('id_empresa', '!=', '')
                ->whereNotNull('id_pipeiro')
                ->where('id_pipeiro', '!=', '');
        })
        ->where('id_edital',@$edital->id)
        ->groupBy('status')
        ->get();
        return $count;
    }
}
