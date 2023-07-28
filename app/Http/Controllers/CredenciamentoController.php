<?php

namespace App\Http\Controllers;

use App\Models\credenciamento;
use App\Models\dadosbancarios;
use App\Models\Empresa_user;
use App\Models\endereco;
use App\Models\Pipeiro_user;
use App\Models\veiculo;
use Illuminate\Http\Request;

class CredenciamentoController extends Controller
{
    //
    static public function checarPendencias($id)
    {
        $pendencias = [];
        $pipeiro = Pipeiro_user::find($id);
        $credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first();
        $veiculo = veiculo::where('id_pipeiro', $pipeiro->id)->first();
        $dadosbancarios = dadosbancarios::where('id_pipeiro', $pipeiro->id)->first();
        $endereco = endereco::where('id_pipeiro', $pipeiro->id)->first();

        if ($credenciamento != null) {
            if ($endereco != null) {
                if (@$endereco->comprovanteresidencia_status != 1 && @$endereco->comprovanteresidencia_status != 3) {
                    $pendencia = [
                        'id' => 'comprovanteresidencia',
                        'nome' => 'Comprovante de Residência',
                        'obs' => $endereco->comprovanteresidencia_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if ($veiculo != null) {
                if (@$veiculo->doc_crlv_status != 1 && @$veiculo->doc_crlv_status != 3) {
                    $pendencia = [
                        'id' => 'doc_crlv',
                        'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                        'obs' => $veiculo->doc_crlv_obs
                    ];
                    array_push($pendencias, $pendencia);
                }

                if (@$veiculo->veiculo_img_status != 1) {
                    $pendencia = [
                        'id' => 'veiculo_img',
                        'nome' => 'Foto do Caminhão',
                        'obs' => $veiculo->veiculo_img_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if ($veiculo->proprio == 0) {
                    if (@$veiculo->doc_cl_status != 1) {
                        $pendencia = [
                            'id' => 'doc_cl',
                            'nome' => 'Contrato de Locação',
                            'obs' => $veiculo->doc_cl_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
            }
            if ($dadosbancarios != null) {
                if (@$dadosbancarios->doc_comprovante_status != 1) {
                    $pendencia = [
                        'id' => 'doc_comprovante',
                        'nome' => 'Comprovante de Dados Bancarios',
                        'obs' => $dadosbancarios->doc_comprovante_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if ($pipeiro != null) {

                if (@$pipeiro->cnhfrente_status != 1) {
                    $pendencia = [
                        'id' => 'cnhfrente',
                        'nome' => 'Foto da CNH',
                        'obs' => $pipeiro->cnhfrente_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$pipeiro->genero == 1) {
                    if ($credenciamento->doc_cqsm_status != 1) {
                        $pendencia = [
                            'id' => 'doc_cqsm',
                            'nome' => 'Certidão de Quitação com o Serviço Militar (para o sexo masculino)',
                            'obs' => $credenciamento->doc_cqsm_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
            }
            if (@$credenciamento->doc_reqcred_status != 1) {
                $pendencia = [
                    'id' => 'doc_reqcred',
                    'nome' => 'Requerimento de Credenciamento (anexo c)',
                    'obs' => $credenciamento->doc_reqcred_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cico_status != 1) {
                $pendencia = [
                    'id' => 'doc_cico',
                    'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações (anexo d)',
                    'obs' => $credenciamento->doc_cico_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cicips_status != 1) {
                $pendencia = [
                    'id' => 'doc_cicips',
                    'nome' => 'Comprovante de Inscrição como Contribuinte Individual da Previdência Social',
                    'obs' => $credenciamento->doc_cicips_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cqe_status != 1) {
                $pendencia = [
                    'id' => 'doc_cqe',
                    'nome' => 'Certidão de Quitação Eleitoral',
                    'obs' => $credenciamento->doc_cqe_obs
                ];
                array_push($pendencias, $pendencia);
            }

            if (@$credenciamento->doc_maed_status != 1) {
                $pendencia = [
                    'id' => 'doc_maed',
                    'nome' => 'Modelo de autorização para exposição de dados (Anexo H)',
                    'obs' => $credenciamento->doc_maed_obs
                ];
                array_push($pendencias, $pendencia);
            }

            // if (@$credenciamento->doc_sicaf_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_sicaf',
            //         'nome' => 'Certificado de Registro no Sistema de Cadastramento Unificado de Fornecedores (SICAF)',
            //         'obs' => $credenciamento->doc_sicaf_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            if (@$credenciamento->doc_ciscc_status != 1) {
                $pendencia = [
                    'id' => 'doc_ciscc',
                    'nome' => 'Comprovante de Inscrição e Situação Cadastral no CPF',
                    'obs' => $credenciamento->doc_ciscc_obs
                ];
                array_push($pendencias, $pendencia);
            }
            // if ($credenciamento->doc_ciem_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_ciem',
            //         'nome' => 'Comprovante de Inscrição Estadual ou Municipal',
            //         'obs' => $credenciamento->doc_ciem_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            if (@$credenciamento->doc_cndf_status != 1) {
                $pendencia = [
                    'id' => 'doc_cndf',
                    'nome' => 'Certidão de Regularidade para com a Fazenda Federal',
                    'obs' => $credenciamento->doc_cndf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cnde_status != 1) {
                $pendencia = [
                    'id' => 'doc_cnde',
                    'nome' => 'Certidão de Regularidade para com a Fazenda Estadual',
                    'obs' => $credenciamento->doc_cnde_obs
                ];
                array_push($pendencias, $pendencia);
            }
            // if (@$credenciamento->doc_cndm_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cndm',
            //         'nome' => 'Certidão Negativa de Débitos Municipais',
            //         'obs' => $credenciamento->doc_cndm_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            if (@$credenciamento->doc_cidt_status != 1) {
                $pendencia = [
                    'id' => 'doc_cidt',
                    'nome' => 'Certidão de Inexistência de Débitos Trabalhistas',
                    'obs' => $credenciamento->doc_cidt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_antt_status != 1) {
                $pendencia = [
                    'id' => 'doc_antt',
                    'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                    'obs' => $credenciamento->doc_antt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_lvs_status != 1) {
                $pendencia = [
                    'id' => 'doc_lvs',
                    'nome' => 'Laudo da Vigilância Sanitária',
                    'obs' => $credenciamento->doc_lvs_obs
                ];
                array_push($pendencias, $pendencia);
            }
            // if ($credenciamento->doc_act_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_act',
            //         'nome' => 'Atestado de Capacidade Técnica',
            //         'obs' => $credenciamento->doc_act_obs
            //     ];;
            //     array_push($pendencias, $pendencia);
            // }

        }
        // if (count($pendencias) > 0) {
        //     $credenciamento->status = 99;
        //     $credenciamento->save();
        // }

        return $pendencias;
    }

    static public function checarPendenciasEmpresa($id)
    {

        $pendencias = [];
        $empresa = Empresa_user::find($id);
        $credenciamento = credenciamento::where("id_empresa", $empresa->id)->first();
        $dadosbancarios = dadosbancarios::where('id_empresa', $empresa->id)->first();
        $endereco = endereco::where('id_empresa', $empresa->id)->first();

        if ($credenciamento != null) {

            if ($empresa != null) {
                if (@$empresa->doc_representante_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_representante',
                        'nome' => 'Declaração de trabalho de menor (Anexo E)',
                        'obs' => $empresa->doc_representante_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_tdm_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_tdm',
                        'nome' => 'Modelo de autorização para exposição de dados (Anexo H)',
                        'obs' => $empresa->doc_emp_tdm_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_ccmei_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_ccmei',
                        'nome' => 'Documento de Constituição da Empresa',
                        'obs' => $empresa->doc_emp_ccmei_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_cicnpj_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_cicnpj',
                        'nome' => 'Cartão de inscrição no Cadastro Nacional de Pessoa Juridica - CNPJ',
                        'obs' => $empresa->doc_emp_cicnpj_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_ciccem_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_ciccem',
                        'nome' => 'Certidão de inscrição no cadastro de contribuintes estadual ou municipal, correspondente a sede do interessado',
                        'obs' => $empresa->doc_emp_ciccem_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_cidijt_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_cidijt',
                        'nome' => 'Certidão de inexistência de débitos inadimplidos perante a justiça do trabalho',
                        'obs' => $empresa->doc_emp_cidijt_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_alf_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_alf',
                        'nome' => 'Certidão de regularidade relativa as contribuições para a Seguridade Social',
                        'obs' => $empresa->doc_emp_alf_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_crrcss_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_crrcss',
                        'nome' => 'Certidão de regularidade relativa as contribuições para a Seguridade Social',
                        'obs' => $empresa->doc_emp_crrcss_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if (@$empresa->doc_emp_crrc_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_emp_crrc',
                        'nome' => 'Certidão de regularidade com referência às contribuições para o FGTS',
                        'obs' => $empresa->doc_emp_crrc_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                // if (@$empresa->doc_emp_ccmei_status != 1) {
                //     $pendencia = [
                //         "dono" => $empresa->razaosocial,
                //         'id' => 'doc_emp_ccmei',
                //         'nome' => 'Documento de Constituição da Empresa',
                //         'obs' => $empresa->doc_emp_ccmei_obs
                //     ];
                //     array_push($pendencias, $pendencia);
                // }
            }
            if ($endereco != null) {
                if (@$endereco->comprovanteresidencia_status != 1) {
                    $pendencia = [
                        "dono" => $empresa->razaosocial,
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
                        "dono" => $empresa->razaosocial,
                        'id' => 'doc_comprovante',
                        'nome' => 'Comprovante de Dados Bancarios',
                        'obs' => $dadosbancarios->doc_comprovante_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }
            if (@$credenciamento->doc_cico_status != 1) {
                $pendencia = [
                    "dono" => $empresa->razaosocial,
                    'id' => 'doc_cico',
                    'nome' => 'Declaração de Conhecimento das Informações para Cumprimento das Obrigações (anexo d)',
                    'obs' => $credenciamento->doc_cico_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_maed_status != 1) {
                $pendencia = [
                    "dono" => $empresa->razaosocial,
                    'id' => 'doc_maed',
                    'nome' => 'Modelo de autorização para exposição de dados (Anexo H)',
                    'obs' => $credenciamento->doc_maed_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cndf_status != 1) {
                $pendencia = [
                    "dono" => $empresa->razaosocial,
                    'id' => 'doc_cndf',
                    'nome' => 'Certidão de regularidade com a Fazenda Federais',
                    'obs' => $credenciamento->doc_cndf_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cndm_status != 1) {
                $pendencia = [
                    "dono" => $empresa->razaosocial,
                    'id' => 'doc_cndm',
                    'nome' => 'Certidão de regularidade com a Fazenda Municipal',
                    'obs' => $credenciamento->doc_cndm_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cnde_status != 1) {
                $pendencia = [
                    "dono" => $empresa->razaosocial,
                    'id' => 'doc_cnde',
                    'nome' => ' Certidão de regularidade com a Fazenda Estadual',
                    'obs' => $credenciamento->doc_cnde_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if ($credenciamento->doc_act_status != 1) {
                $pendencia = [
                    "dono" => $empresa->razaosocial,
                    'id' => 'doc_act',
                    'nome' => 'Atestado de Capacidade Técnica',
                    'obs' => $credenciamento->doc_act_obs
                ];;
                array_push($pendencias, $pendencia);
            }
            // if (@$credenciamento->doc_cicips_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cicips',
            //         'nome' => 'Comprovante de Inscrição como Contribuinte Individual da Previdência Social',
            //         'obs' => $credenciamento->doc_cicips_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            // if (@$credenciamento->doc_cqe_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cqe',
            //         'nome' => 'Certidão de Quitação Eleitoral',
            //         'obs' => $credenciamento->doc_cqe_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }


            // if (@$credenciamento->doc_ciscc_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_ciscc',
            //         'nome' => 'Comprovante de Inscrição e Situação Cadastral no CPF',
            //         'obs' => $credenciamento->doc_ciscc_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }


            // if (@$credenciamento->doc_cidt_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cidt',
            //         'nome' => 'Certidão de Inexistência de Débitos Trabalhistas',
            //         'obs' => $credenciamento->doc_cidt_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            // if (@$credenciamento->doc_antt_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_antt',
            //         'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
            //         'obs' => $credenciamento->doc_antt_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            // if (@$credenciamento->doc_lvs_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_lvs',
            //         'nome' => 'Laudo da Vigilância Sanitária',
            //         'obs' => $credenciamento->doc_lvs_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }

        }
        // if (count($pendencias) > 0) {
        //     $credenciamento->status = 99;
        //     $credenciamento->save();
        // }

        return $pendencias;
    }

    static public function checarPendenciasPipeiroEmpresa($id)
    {
        $pendencias = [];
        $pipeiro = Pipeiro_user::find($id);
        $credenciamento = credenciamento::where("id_pipeiro", $pipeiro->id)->first();
        $veiculo = veiculo::where('id_pipeiro', $pipeiro->id)->first();

        if ($credenciamento != null) {

            if ($veiculo != null) {
                if (@$veiculo->doc_crlv_status != 1) {
                    $pendencia = [
                        "dono" => $pipeiro->nome,
                        'id' => 'doc_crlv',
                        'nome' => 'CERTIFICADO DE REGISTRO E LICENCIAMENTO VEICULAR (CRLV)',
                        'obs' => $veiculo->doc_crlv_obs
                    ];
                    array_push($pendencias, $pendencia);
                }

                if (@$veiculo->veiculo_img_status != 1) {
                    $pendencia = [
                        "dono" => $pipeiro->nome,
                        'id' => 'veiculo_img',
                        'nome' => 'Foto do Caminhão',
                        'obs' => $veiculo->veiculo_img_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
                if ($veiculo->proprio == 0) {
                    if (@$veiculo->doc_cl_status != 1) {
                        $pendencia = [
                            "dono" => $pipeiro->nome,
                            'id' => 'doc_cl',
                            'nome' => 'Contrato de Locação',
                            'obs' => $veiculo->doc_cl_obs
                        ];
                        array_push($pendencias, $pendencia);
                    }
                }
            }

            if ($pipeiro != null) {

                if (@$pipeiro->cnhfrente_status != 1) {
                    $pendencia = [
                        "dono" => $pipeiro->nome,
                        'id' => 'cnhfrente',
                        'nome' => 'Foto da CNH',
                        'obs' => $pipeiro->cnhfrente_obs
                    ];
                    array_push($pendencias, $pendencia);
                }
            }

            if (@$credenciamento->doc_reqcred_status != 1) {
                $pendencia = [
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_reqcred',
                    'nome' => 'Requerimento de Credenciamento (anexo c)',
                    'obs' => $credenciamento->doc_reqcred_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_cicips_status != 1) {
                $pendencia = [
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_cicips',
                    'nome' => 'Comprovante de Inscrição como Contribuinte Individual da Previdência Social',
                    'obs' => $credenciamento->doc_cicips_obs
                ];
                array_push($pendencias, $pendencia);
            }
            // if (@$credenciamento->doc_cqe_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cqe',
            //         'nome' => 'Certidão de Quitação Eleitoral',
            //         'obs' => $credenciamento->doc_cqe_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }


            // if (@$credenciamento->doc_ciscc_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_ciscc',
            //         'nome' => 'Comprovante de Inscrição e Situação Cadastral no CPF',
            //         'obs' => $credenciamento->doc_ciscc_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }

            // if (@$credenciamento->doc_cndf_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cndf',
            //         'nome' => 'Certidão Negativa de Débitos Federais',
            //         'obs' => $credenciamento->doc_cndf_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            // if (@$credenciamento->doc_cnde_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cnde',
            //         'nome' => 'Certidão Negativa de Débitos Estaduais',
            //         'obs' => $credenciamento->doc_cnde_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }

            // if (@$credenciamento->doc_cidt_status != 1) {
            //     $pendencia = [
            //         'id' => 'doc_cidt',
            //         'nome' => 'Certidão de Inexistência de Débitos Trabalhistas',
            //         'obs' => $credenciamento->doc_cidt_obs
            //     ];
            //     array_push($pendencias, $pendencia);
            // }
            if (@$credenciamento->doc_antt_status != 1) {
                $pendencia = [
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_antt',
                    'nome' => 'Registro ou Inscrição junto à Agência Nacional de Transporte Terrestre (ANTT)',
                    'obs' => $credenciamento->doc_antt_obs
                ];
                array_push($pendencias, $pendencia);
            }
            if (@$credenciamento->doc_lvs_status != 1) {
                $pendencia = [
                    "dono" => $pipeiro->nome,
                    'id' => 'doc_lvs',
                    'nome' => 'Laudo da Vigilância Sanitária',
                    'obs' => $credenciamento->doc_lvs_obs
                ];
                array_push($pendencias, $pendencia);
            }
        }
        // if (count($pendencias) > 0) {
        //     $credenciamento->status = 99;
        //     $credenciamento->save();
        // }

        return $pendencias;
    }

    static public function pendenciasMotorista($id)
    {
        $todaspendencias = [];
        // array_push($todaspendencias, CredenciamentoController::checarPendenciasEmpresa($id));
        $motoristas = Pipeiro_user::where('id_empresa', $id)->get();
        foreach ($motoristas as $mot) {
            array_push($todaspendencias, CredenciamentoController::checarPendenciasPipeiroEmpresa($mot->id));
        }
        return $todaspendencias;
    }
}
