<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::redirect('/', '/login');

Route::get('/home', 'AdminController@index')->name('home');
Route::get('/v_test', 'AdminController@v_test')->name('v_test');

Route::get('/profile', 'AdminController@profile')->name('profile');


Route::get('pagamentos/estudantes/{id}','Turmas@getEstudantes');

Route::get('mesesValidos/{id}/{ano}','Estudantes@getMesesValidos');

Route::get('busqueda/{valor}','Pagamentos@busqueda');
Route::get('caixa/busquedaCaixa/{valor}','Caixa@busqueda');
Route::get('busquedaTurma/{valor}','Pagamentos@busquedaPorTurma');
Route::get('busquedaTurma/{valor}','Pagamentos@busquedaPorTurma');
Route::get('estudantesTurma/{id}','Estudantes@estudantesTurma');
Route::get('pagamentosEstudantes/{id}/{ano}','Pagamentos@pagamentosJson');
Route::get('estudanteDadoID/{id}','Estudantes@estudanteDadoID');

//Route::post('storePagamentos','Pagamentos@novoStore');

Route::post('pagamentosMes/storePagamentos',[
    'as'=>'storePagamentos',
    'uses'=>'Pagamentos@novoStore'
]);  



//Route::get('resultado','Pagamentos@resultado');



/*Route::get('/',[
    'as'=>'home',
    'uses'=>'FrontController@index'
]);*/

Route::resource('emolumento','EmolumentoController');

/*Pagamentos*/

Route::get('pagamentos',[
    'as'=>'indexPagamentos',
    'uses'=>'Pagamentos@index'
]);  

Route::get('propinas',[
    'as'=>'propinas',
    'uses'=>'Pagamentos@propinas'
]);
Route::get('propinas/fazerPagamento',[
    'as'=>'fazerPagamento',
    'uses'=>'Pagamentos@fazerPagamento'
]);

Route::get('propinas/fazerPagamentoTemporal',[
    'as'=>'fazerPagamentoTemporal',
    'uses'=>'Pagamentos@fazerPagamentoTemporal'
]);
Route::get('propinas/fichaPagamento/{id}',[
    'as'=>'fichaPagamento',
    'uses'=>'Pagamentos@fichaPagamento'
]);
Route::post('propinas/salvarFicha',[
    'as'=>'salvarFicha',
    'uses'=>'Pagamentos@salvarFicha'
]);

Route::get('propinas/fazerPagamentoMes',[
    'as'=>'fazerPagamentoMes',
    'uses'=>'Pagamentos@fazerPagamentoMes'
]);

Route::get('propinas/confirmarPagamento',[
    'as'=>'confirmarPagamento',
    'uses'=>'Pagamentos@confirmarPagamento'
]);

Route::get('pagamentos/emolumento',[
    'as'=>'pagarEmolumento',
    'uses'=>'Pagamentos@pagarEmolumento'
]);

Route::get('pagamentos/emolumentoGeral',[
    'as'=>'pagarEmolumentoGeral',
    'uses'=>'Pagamentos@pagarEmolumentoGeral'
]); 
Route::get('propinasGeral/',[
    'as'=>'propinasGeral',
    'uses'=>'Pagamentos@propinasGeral'
]);
Route::get('eliminarPagamento/{id}',[
    'as'=>'eliminarPagamento',
    'uses'=>'Pagamentos@eliminarPagamento'
]); 
Route::get('pagamentosMes/',[
    'as'=>'pagamentosMes',
    'uses'=>'Pagamentos@pagamentoDadoUmMes'
]);   

Route::any('relatoriosPagamentos/',[
    'as'=>'relatoriosPagamentos',
    'uses'=>'Pagamentos@relatoriosPagamentos'
]);
Route::post('relatoriosPagamentos2',[
    'as'=>'relatoriosPagamentos2',
    'uses'=>'Pagamentos@relatoriosPagamentos2'
]);

Route::post('relatorios',[
    'as'=>'resultadosPagamentos',
    'uses'=>'Pagamentos@resultRelatoriosPagamentos'
]);  
Route::get('recibo_segundaVia/{id}', 'Pagamentos@recibo_segundaVia')->name('recibo_segundaVia');




//Route::get('pagamentos','Pagamentos@index');

/*Route::get('pagamentos',[
    'as'=>'pagamentos',
    'uses'=>'Pagamentos@index'
]);

Route::get('pagamentos/registrar',[
    'as'=>'registrarPagamento',
    'uses'=>'Pagamentos@registrar'
]);


Route::get('pagamentos/inserir',[
    'as'=>'inserirPagamento',
    'uses'=>'Pagamentos@inserir'
]);

Route::get('pagamentos/inserir',[
    'as'=>'confirmarPagamento',
    'uses'=>'Pagamentos@confirmarPagamento'
]);


Route::get('pagamentos/emolumento',[
    'as'=>'pagarEmolumento',
    'uses'=>'Pagamentos@pagarEmolumento'
]);

Route::get('pagamentos/emolumentoGeral',[
    'as'=>'pagarEmolumentoGeral',
    'uses'=>'Pagamentos@pagarEmolumentoGeral'
]);  */



/* Dispesas  */

Route::get('dispesas',[
    'as'=>'dispesas',
    'uses'=>'Dispesas@indexDispesasTotais'
]);

Route::get('dispesas/inserir',[
    'as'=>'inserirDispesaTotal',
    'uses'=>'Dispesas@inserirDispesasTotais'
]);

Route::get('dispesasDpto/inserir',[
    'as'=>'inserirDispesaDpto',
    'uses'=>'Dispesas@inserirDispesas'
]);

Route::get('dispesas/store',[
    'as'=>'storeDispesasTotais',
    'uses'=>'Dispesas@storeDispesasTotais'
]);

Route::get('dispesasDpto/store',[
    'as'=>'storeDispesasDpto',
    'uses'=>'Dispesas@storeDispesas'
]);

Route::get('dispesas/distribuir',[
    'as'=>'distribuirDispesas',
    'uses'=>'Dispesas@distribuirDispesas'
]);
Route::get('dispesas/indexTest',[
    'as'=>'indexTest',
    'uses'=>'Dispesas@indexTest'
]);
Route::get('deleteDispesasDpto/{id}',[
    'as'=>'deleteDispesa',
    'uses'=>'Dispesas@deleteDispesaDpto'
]);

Route::get('ordenarDispesasDpto/{dpto}/{ano?}',[
    'as'=>'ordenarDispesaDpto',
    'uses'=>'Dispesas@ordenarDispesaDpto'
]);

Route::get('deleteDispesasTotal/{id}',[
    'as'=>'deleteDispesaTotal',
    'uses'=>'Dispesas@deleteDispesaTotal'
]);

Route::get('dispesasDpto/update/{dispesa}/{cantidad}',[
    'as'=>'updateDispesaDpto',
    'uses'=>'Dispesas@updateDispesaDpto'
]);

Route::get('editarDispesasTotal/{id}',[
    'as'=>'editarDispesasTotal',
    'uses'=>'Dispesas@editarDispesasTotal'
]);

Route::get('updateDispesasTotal/{id}',[
    'as'=>'updateDispesasTotal',
    'uses'=>'Dispesas@updateDispesasTotal'
]);





/*Estudantes*/
Route::get('estudantes/listar/{nome?}',[
    'as'=>'listarEstudantes',
    'uses'=>'Estudantes@index'
]);
Route::get('estudantes/inserir',[
    'as'=>'inserirEstudantes',
    'uses'=>'Estudantes@inserir'
]);

Route::post('estudantes/store',[
    'as'=>'storeEstudantes',
    'uses'=>'Estudantes@store'
]);
//nova forma par registrar as matriculas
Route::post('estudantes/registrarMatricula',[
    'as'=>'registrarMatricula',
    'uses'=>'Estudantes@registrarMatricula'
]);

Route::get('estudantes/delete/{id}',[
    'as'=>'eliminarEstudantes',
    'uses'=>'Estudantes@delete'
]);

Route::get('estudantes/editar/{id}',[
    'as'=>'editarEstudantes',
    'uses'=>'Estudantes@editar'
]);

Route::post('estudantes/update/{id}', 'Estudantes@update')->name('update_estudante');


Route::get('estudantes/ficha/{id}',[
    'as'=>'fichaEstudante',
    'uses'=>'Estudantes@fichaEstudante'
]);
Route::get('estudantes/pdf_ficha/{id}',[
    'as'=>'pdf_fichaEstudante',
    'uses'=>'Estudantes@pdfFichaEstudante'
]);

Route::post('mostrarFicha',[
    'as'=>'mostrarFicha',
    'uses'=>'Estudantes@buscarFicha'
]);

Route::get('estudantes/pdfEstudantesTurma/{id}',[
    'as'=>'pdfEstudantesTurma',
    'uses'=>'Estudantes@pdfTurma'
]);
Route::get('pdfEstudantesCartao/{id}',[
    'as'=>'pdfEstudantesCartao',
    'uses'=>'Estudantes@pdfTurmaCartao'
]);
Route::get('estudantes/pdfActaAvaliacao/{id}',[
    'as'=>'pdfActaAvaliacao',
    'uses'=>'Estudantes@pdfActaAvaliacao'
]);

Route::get('estudantesMatriculados', 'Estudantes@estudantesMatriculados')->name('estudantesMatriculados');



/*Turmas*/
Route::get('turmas/listar',[
    'as'=>'listarTurmas',
    'uses'=>'Turmas@index'
]);

Route::get('turmas/inserir',[
    'as'=>'inserirTurmas',
    'uses'=>'Turmas@inserir'
]);

Route::get('turmas/store',[
    'as'=>'storeTurmas',
    'uses'=>'Turmas@store'
]);

Route::get('turmas/delete/{id}',[
    'as'=>'eliminarTurmas',
    'uses'=>'Turmas@delete'
]);

Route::get('turmas/editar/{id}',[
    'as'=>'editarTurmas',
    'uses'=>'Turmas@editar'
]);

Route::get('turmas/update/{id}',[
    'as'=>'updateTurmas',
    'uses'=>'Turmas@update'
]);

Route::get('turmas/estudantes-turmas',[
    'as'=>'estudantes-turmas',
    'uses'=>'Turmas@estudantesTurmas'
]);



/*Depaartamentos*/
Route::get('departamentos/listar',[
    'as'=>'listarDepartamentos',
    'uses'=>'Departamentos@index'
]);

Route::get('departamentos/inserir',[
    'as'=>'inserirDepartamentos',
    'uses'=>'Departamentos@inserir'
]);

Route::get('departamentos/store',[
    'as'=>'storeDepartamentos',
    'uses'=>'Departamentos@store'
]);

Route::get('departamentos/delete/{id}',[
    'as'=>'eliminarDepartamentos',
    'uses'=>'Departamentos@delete'
]);

Route::get('departamentos/editar/{id}',[
    'as'=>'editarDepartamentos',
    'uses'=>'Departamentos@editar'
]);

Route::get('departamentos/update/{id}',[
    'as'=>'updateDepartamentos',
    'uses'=>'Departamentos@update'
]);


/*Usuarios*/
Route::get('usuarios/listar',[
    'as'=>'listarUsuarios',
    'uses'=>'Usuarios@index'
]);

Route::get('usuarios/inserir',[
    'as'=>'inserirUsuarios',
    'uses'=>'Usuarios@inserir'
]);

Route::get('usuarios/store',[
    'as'=>'storeUsuarios',
    'uses'=>'Usuarios@store'
]);

Route::get('usuarios/delete/{id}',[
    'as'=>'eliminarUsuarios',
    'uses'=>'Usuarios@delete'
]);

Route::get('usuarios/editar/{id}',[
    'as'=>'editarUsuarios',
    'uses'=>'Usuarios@editar'
]);

Route::get('usuarios/update/{id}',[
    'as'=>'updateUsuarios',
    'uses'=>'Usuarios@update'
]);





/*Tipos Usuarios*/
Route::get('tipos_usuarios/listar',[
    'as'=>'listarTiposUsuarios',
    'uses'=>'TiposUsuarios@index'
]);

Route::get('tipos_usuarios/inserir',[
    'as'=>'inserirTiposUsuarios',
    'uses'=>'TiposUsuarios@inserir'
]);

Route::get('tiposUsuarios/store',[
    'as'=>'storeTiposUsuarios',
    'uses'=>'TiposUsuarios@store'
]);

Route::get('tiposUsuarios/delete/{id}',[
    'as'=>'eliminarTiposUsuarios',
    'uses'=>'TiposUsuarios@delete'
]);

Route::get('tiposUsuarios/editar/{id}',[
    'as'=>'editarTiposUsuarios',
    'uses'=>'TiposUsuarios@editar'
]);

Route::get('tiposUsuarios/update/{id}',[
    'as'=>'updateTiposUsuarios',
    'uses'=>'TiposUsuarios@update'
]);



/*Emolumentos*/
Route::get('emolumentos/listar',[
    'as'=>'listarEmolumentos',
    'uses'=>'Emolumentos@index'
]);

Route::get('emolumentos/inserir',[
    'as'=>'inserirEmolumentos',
    'uses'=>'Emolumentos@inserir'
]);

Route::get('emolumentos/store',[
    'as'=>'storeEmolumentos',
    'uses'=>'Emolumentos@store'
]);

Route::get('emolumentos/delete/{id}',[
    'as'=>'eliminarEmolumentos',
    'uses'=>'Emolumentos@delete'
]);

Route::get('emolumentos/editar/{id}',[
    'as'=>'editarEmolumentos',
    'uses'=>'Emolumentos@editar'
]);

Route::get('emolumentos/update/{id}',[
    'as'=>'updateEmolumentos',
    'uses'=>'Emolumentos@update'
]);

Route::get('caixa/index',[
    'as'=>'caixa',
    'uses'=>'Caixa@index'
]);

Route::get('caixa/indexDispesas',[
    'as'=>'indexDispesas',
    'uses'=>'Caixa@indexDispesas'
]);

Route::get('caixa/registrarDispesas2',[
    'as'=>'registrarDispesas2',
    'uses'=>'Caixa@registrarDispesas'
]);

Route::post('caixa/storeDispesas',[
    'as'=>'storeDispesas',
    'uses'=>'Caixa@storeDispesas'
]);

Route::get('caixa/editarDispesas/{id}',[
    'as'=>'editarDispesas',
    'uses'=>'Caixa@editarDispesas'
]);

Route::get('caixa/editarPagamento/{id}',[
    'as'=>'editarPagamento',
    'uses'=>'Caixa@editarPagamento'
]);

Route::get('caixa/updateDispesas/{id}',[
    'as'=>'updateDispesas',
    'uses'=>'Caixa@updateDispesas'
]);
Route::post('caixa/updatePagamento/{id}',[
    'as'=>'updatePagamento',
    'uses'=>'Caixa@updatePagamento'
]);

Route::get('caixa/deleteDispesas/{id}',[
    'as'=>'deleteDispesas',
    'uses'=>'Caixa@deleteDispesas'
]);

Route::get('caixa/filtrarDispesasMes',[
    'as'=>'filtrarDispesasMes',
    'uses'=>'Caixa@filtrarDispesasMes'
]);
Route::post('caixa/filtrarPagamentosMes',[
    'as'=>'filtrarPagamentosMes',
    'uses'=>'Caixa@filtrarPagamentosMes'
]);


Route::get('caixa/fichaPagamento/{id}',[
    'as'=>'caixaFichaPagamento',
    'uses'=>'Caixa@fichaPagamento'
]);

Route::get('caixa/propinas',[
    'as'=>'caixaPropinas',
    'uses'=>'Caixa@Propinas'
]);

Route::get('caixa/pagamentoEmolumento',[
    'as'=>'pagamentoEmolumento',
    'uses'=>'Caixa@pagamentoEmolumento'
]);

Route::post('caixa/storePagamentoEmolumento',[
    'as'=>'storePagamentoEmolumento',
    'uses'=>'Caixa@storePagamentoEmolumento'
]);

Route::get('caixa/pagamentosDia',[
    'as'=>'pagamentosDia',
    'uses'=>'Caixa@pagamentosDia'
]);

Route::get('caixa/diarioCaixaNovo',[
    'as'=>'diarioCaixaNovo',
    'uses'=>'Caixa@diarioCaixaNovo'
]);

Route::post('caixa/diarioCaixaNovo',[
    'as'=>'procDiarioCaixaNovo',
    'uses'=>'Caixa@diarioCaixaNovo'
]);
Route::get('pagamentos/gerarComprovativo/{id}',[
    'as'=>'gerarComprovativo',
    'uses'=>'Pagamentos@gerarComprovativo'
]);
Route::get('storage/{filename}', function ($filename)
{
       return Image::make(public_path('imagenes-perfil/' . $filename))->resize(50,50)->response();
});

//Consumiveis
Route::get('index-consumiveis', 'Consumiveis@index')->name('index-consumiveis');
Route::get('inserirConsumiveis', 'Consumiveis@inserir')->name('inserirConsumiveis');
Route::get('editarConsumiveis/{id}', 'Consumiveis@editar')->name('editarConsumiveis');
Route::get('eliminarConsumiveis/{id}', 'Consumiveis@eliminar')->name('eliminarConsumiveis');
Route::get('storeConsumivel', 'Consumiveis@store')->name('storeConsumivel');
Route::post('updateConsumivel/{id}', 'Consumiveis@update')->name('updateConsumiveis');


//Entrdas
Route::get('listarEntradas', 'Entradas@index')->name('listarEntradas');
Route::get('inserirEntrada', 'Entradas@inserir')->name('inserirEntrada');
Route::get('editarEntrada/{id}', 'Entradas@editar')->name('editarEntrada');
Route::get('eliminarEntrada/{id}', 'Entradas@eliminar')->name('eliminarEntrada');
Route::post('storeEntrada', 'Entradas@store')->name('storeEntrada');
Route::post('updateEntrada/{id}', 'Entradas@update')->name('updateEntrada');

//Saidas
Route::get('listarSaidas', 'Saidas@index')->name('listarSaidas');
Route::get('inserirSaida', 'Saidas@inserir')->name('inserirSaida');
Route::get('editarSaida/{id}', 'Saidas@editar')->name('editarSaida');
Route::get('eliminarSaida/{id}', 'Saidas@eliminar')->name('eliminarSaida');
Route::post('storeSaida', 'Saidas@store')->name('storeSaida');
Route::post('updateSaida/{id}', 'Saidas@update')->name('updateSaida');

//stock
Route::get('stock', 'ControladorStock@index')->name('stock');

//relatorios
Route::get('descargar-estudantes', 'Estudantes@pdf')->name('estudantes.pdf');


Route::get('relatorio-ingresos', 'Relatorios@ingresos')->name('ingresos.pdf');
Route::get('relatorio-test/{mes}', 'Relatorios@test')->name('test.pdf');

Route::post('gerarComprovativo',[
    'as'=>'pdfComprovativo',
    'uses'=>'Pagamentos@pdfComprovativo'
]);

Route::get('estadoConta/{id}/{ano}',[
    'as'=>'estadoConta',
    'uses'=>'Pagamentos@estadoConta'
]);
Route::get('estadoConta/{id}/{ano}', 'Pagamentos@estadoConta')->name('estado_conta');


/*Professores*/
Route::any('index-professores', 'Professores@index')->name('index-professores');
Route::get('inserirProfessores', 'Professores@inserir')->name('inserirProfessores');
Route::post('salvarProfessores', 'Professores@salvar')->name('salvarProfessores');
Route::get('deleteProfessores/{id}', 'Professores@delete')->name('deleteProfessores');
Route::get('editarProfessores/{id}', 'Professores@editar')->name('editarProfessores');
Route::post('actualizarProfessores', 'Professores@actualizar')->name('actualizarProfessores');
Route::get('disciplinas-Professores/{email?}', 'Professores@disciplinasProfessores')->name('disciplinas-professores');
Route::get('examesAdmissao', 'Professores@examesAdmissao')->name('examesAdmissao');




//relatorio pagamentos
Route::get('relatorioPagamentos', 'Pagamentos@relatorioPagamentos')->name('relatorioPagamentos');
Route::get('pdfMapaPagamentos/{idTurma}/{ano}', 'Pagamentos@pdfMapaPagamentos')->name('pdfMapaPagamentos');
Route::get('pdfMapaCompletoPagamentos', 'Pagamentos@pdfMapaCompletoPagamentos')->name('pdfMapaCompletoPagamentos');


//Diario Caixa
Route::get('pdfDiarioCaixa/{date}', 'Pagamentos@pdfDiarioCaixa')->name('pdfDiarioCaixa');
Route::get('pdfEntradaSalida/{mes}/{ano}', 'Caixa@pdfEntradaSalida')->name('pdfEntradaSalida');



//Cursos

Route::get('matriculadosCurso', 'Cursos@matriculadosPorCurso')->name('matriculadosPorCurso');


//Pautas
Route::get('listaPautas', 'Pautas@index')->name('listaPautas');
Route::get('inserirPauta', 'Pautas@inserir')->name('inserirPauta');
Route::post('storePauta', 'Pautas@store')->name('storePauta');
//Route::post('mostrarPauta', 'Pautas@mostrar')->name('mostrarPauta');
Route::get('mostrarPauta/{id}', 'Pautas@mostrarPauta')->name('mostrarPauta');
Route::get('mostrarPauta2/{id}', 'Pautas@mostrarPauta2')->name('mostrarPauta2');
Route::get('avaliar', 'Pautas@showAvaliarDisciplina')->name('avaliar');
Route::get('avaliarPauta/{id}', 'Pautas@avaliarPauta')->name('avaliarPauta');
Route::post('avaliarEstudante', 'Pautas@avaliarEstudante')->name('avaliarEstudante');
Route::get('eliminarPauta/{id}', 'Pautas@eliminar')->name('eliminarPauta');
Route::post('gerarPdfPauta', 'Pautas@gerarPdfPauta')->name('gerarPdfPauta');
Route::post('pdfPauta', 'Pautas@gerarPdfPauta')->name('pdfPauta');





//Disciplinas

Route::any('listarDisciplinas', 'Disciplinas@index')->name('listarDisciplinas');
Route::get('inserirDisciplinas', 'Disciplinas@inserir')->name('inserirDisciplinas');
Route::get('editarDisciplinas/{id}', 'Disciplinas@editar')->name('editarDisciplinas');
Route::post('updateDisciplinas', 'Disciplinas@update')->name('updateDisciplinas');
Route::post('salvarDisciplinas', 'Disciplinas@store')->name('salvarDisciplinas');
Route::get('eliminarDisciplinas/{id}', 'Disciplinas@delete')->name('eliminarDisciplinas');



//Candidatos
Route::get('indexCandidatos', 'Candidatos@index')->name('indexCandidatos');
Route::any('listarResultadosProcesso/{idProc}', 'Candidatos@listarResultadosProcesso')->name('resultadosProcesso');
Route::get('listarCandidatos/{idProc}', 'Candidatos@listarCandidatos')->name('listarCandidatos');
Route::any('listarInscritos/{idProc}', 'Candidatos@listarInscritos')->name('listarInscritos');
Route::get('indexMatriculas/{idProc}', 'Candidatos@indexMatriculas')->name('indexMatriculas');
Route::get('matricular/{id}/{idProc}', 'Candidatos@matricular')->name('matricularCandidato');
Route::post('storeCandidato', 'Candidatos@store')->name('storeCandidato');
Route::get('editarCandidato/{id}/{idProc}', 'Candidatos@editar')->name('editarCandidato');
Route::post('updateCandidato', 'Candidatos@update')->name('updateCandidato');
Route::post('mudarEstadoCandidatos', 'Candidatos@mudarEstadoCandidatos')->name('mudarEstadoCandidatos');
Route::get('mudarEstadoInscrito/{id}/{idProc}', 'Candidatos@mudarEstadoInscrito')->name('mudarEstadoInscrito');
Route::get('mudarEstadoAprovado/{id}/{idProc}', 'Candidatos@mudarEstadoAprovado')->name('mudarEstadoAprovado');
Route::get('mudarEstadoReprovado/{id}/{idProc}', 'Candidatos@mudarEstadoReprovado')->name('mudarEstadoReprovado');
Route::get('mudarEstadoSegundaChamada/{id}/{idProc}', 'Candidatos@mudarEstadoSegundaChamada')->name('mudarEstadoSegundaChamada');

Route::post('eliminarCandidato', 'Candidatos@delete')->name('eliminarCandidato');
Route::get('resultadosCandidatos', 'Candidatos@resultados')->name('resultadosCandidatos');
Route::get('listarCandidaturas', 'Facturas@listarFacturasCandidaturas')->name('listarCandidaturas');
Route::get('listarMatriculas', 'Estudantes@listarMatriculas')->name('listarMatriculas');
Route::get('pagamentoInscricao/{codigo}', 'Pagamentos@pagamentoInscricao')->name('pagamentoInscricao');
Route::get('pagamentoMatricula/{codigo}', 'Pagamentos@pagamentoMatricula')->name('pagamentoMatricula');
Route::get('pdfListaInscritos/{curso_id?}', 'Candidatos@pdfListaInscritos')->name('pdfListaInscritos');
Route::get('pdfListaInscritosSegCh/{curso_id?}', 'Candidatos@pdfListaInscritosSegCh')->name('pdfListaInscritosSegCh');

Route::get('pdfActaExameCand/{curso?}', 'Candidatos@pdfActaExame')->name('pdfActaExameCand');
Route::get('pdfActaExameCandSegCh/{curso?}', 'Candidatos@pdfActaExameSegCh')->name('pdfActaExameCandSegCh');










//Processos Candidaturas
Route::get('listarProcessosCandidaturas/{id}', 'ProcessosCandidaturas@listar')->name('listarProcessosCandidaturas');
Route::get('listar_todos','ProcessosCandidaturas@listar_todos')->name('listar_todos');
Route::get('registrar','ProcessosCandidaturas@inserir')->name('inserir_processoCandidatura');
Route::post('store_processoCandidatura','ProcessosCandidaturas@store')->name('store_processoCandidatura');
Route::get('eliminar/{id}','ProcessosCandidaturas@eliminar')->name('eliminarProcessosCandidaturas');
Route::get('addCursoCandidatura/{idProc}/{idCurso}', 'ProcessosCandidaturas@addCurso')->name('addCursoCandidatura');
Route::get('deleteCursoCandidatura/{idProc}/{idCurso}', 'ProcessosCandidaturas@deleteCurso')->name('deleteCursoCandidatura');

Route::post('addCursoToExameCandidatura', 'ProcessosCandidaturas@addCursoToExame')->name('addCursoToExameCandidatura');
Route::get('deleteCursoToExameCandidatura/{idexame}/{idCurso}', 'ProcessosCandidaturas@deleteCursoToExame')->name('deleteCursoToExameCandidatura');
Route::get('criarPautaExameCandidatura/{idProc}/{idExame}/{idProf}/{idCurso}', 'ProcessosCandidaturas@criarPautaExameCandidatura')->name('criarPautaExameCandidatura');
Route::get('listarPautaExameCandidatura/{idProc}/{idExame}/{idCurso}', 'ProcessosCandidaturas@listarPauta')->name('listarPautaExameCandidatura');
Route::post('avaliarCandidato', 'ProcessosCandidaturas@avaliarCandidato')->name('avaliarCandidato');
Route::post('addExameProcesso', 'ProcessosCandidaturas@addExameToProcesso')->name('addExameToProcesso');
Route::post('definirValorInscricao', 'ProcessosCandidaturas@definirValorInscricao')->name('definirValorInscricao');

Route::get('addDocumentoToProcesso/{idDoc}/{idProc}', 'ProcessosCandidaturas@addDocumentoToProcesso')->name('addDocumentoToProcesso');
Route::get('deleteDocumentoToProcesso/{idDoc}/{idProc}', 'ProcessosCandidaturas@deleteDocumentoToProcesso')->name('deleteDocumentoToProcesso');
Route::post('addDocumento', 'ProcessosCandidaturas@addDocumento')->name('addDocumento');
Route::get('actualizarResultados/{idProc}', 'ProcessosCandidaturas@actualizarResultados')->name('actualizarResultados');
Route::get('editarDocumento/{idDoc}', 'ProcessosCandidaturas@editarDocumento')->name('editarDocumento');
Route::post('updateDocumento', 'ProcessosCandidaturas@updateDocumento')->name('updateDocumento');
Route::post('documentos/update','ProcessosCandidaturas@updateDoc');
Route::post('corte/update','ProcessosCandidaturas@definirCorte');
Route::post('exame/update','ProcessosCandidaturas@editarExame');
Route::post('peso/update','ProcessosCandidaturas@editarPeso');
Route::get('prof/load','ProcessosCandidaturas@loadProfessores');
Route::post('prof/update','ProcessosCandidaturas@updateProfessores');
Route::get('exame/load','ProcessosCandidaturas@loadExames');
Route::post('cursoExame/update','ProcessosCandidaturas@cursoExameUpdate');
Route::post('aval/update','ProcessosCandidaturas@avalUpdate');
Route::get('aval/load','ProcessosCandidaturas@loadAval');

Route::get('inscricao/update','Estudantes@inscricaoUpdate');
Route::get('inscricao/load','Estudantes@inscricaoLoad')->name('inscricaoLoad');

Route::post('estudantes/disciplinasInscricao','Estudantes@mostrarDiscInscricao')->name('mostrarDiscInscricao');
Route::post('estudantes/fazerInscricao','Estudantes@fazerInscricao')->name('fazerInscricao');
Route::post('estudantes/fazerInscricaoAtraso','Estudantes@fazerInscricaoAtraso')->name('fazerInscricaoAtraso');

Route::any('listar_candidatos','ProcessosCandidaturas@listar_candidatos')->name('listar_candidatos');
Route::any('eliminar_axame_candidatura/{exame_id}','ProcessosCandidaturas@eliminarExame')->name('eliminar_axame_candidatura');








//Rotas das avaliaçoes disciplinas
//F1
Route::get('avalF1/update','Pautas@avalF1Update');
Route::get('avalF1/load','Pautas@loadAvalF1');
//F2
Route::get('avalF2/update','Pautas@avalF2Update');
Route::get('avalF2/load','Pautas@loadAvalF2');
//F3
Route::get('avalF3/update','Pautas@avalF3Update');
Route::get('avalF3/load','Pautas@loadAvalF3');
//Ex1
Route::get('avalEx1/update','Pautas@avalEx1Update');
Route::get('avalEx1/load','Pautas@loadAvalEx1');
//Ex2
Route::get('avalEx2/update','Pautas@avalEx2Update');
Route::get('avalEx2/load','Pautas@loadAvalEx2');
//Ex3
Route::get('avalEx3/update','Pautas@avalEx3Update');
Route::get('avalEx3/load','Pautas@loadAvalEx3');
//MAC
Route::get('avalMAC/update','Pautas@avalMACUpdate');
Route::get('avalMAC/load','Pautas@loadAvalMAC');




Route::get('municipios/{idProv}', 'ProcessosCandidaturas@obterMunicipios');
Route::post('validarEmail', 'ProcessosCandidaturas@checkEmail')->name('validarEmail');

//Route::get('municipios2/{idProv}', 'ProcessosCandidaturas@obterMunicipios');

Route::get('publicarPauta/{idPauta}', 'Pautas@publicarPauta')->name('publicarPauta');


//Cursos

Route::get('listarCursos', 'Cursos@listarCursos')->name('listarCursos');
Route::get('addCurso', 'Cursos@addCurso')->name('addCurso');
Route::post('storeCurso', 'Cursos@store')->name('storeCurso');
Route::get('eliminarCurso/{id}', 'Cursos@eliminar')->name('eliminarCurso');
Route::get('editarCurso/{id}', 'Cursos@editar')->name('editarCurso');
Route::post('actualizarCurso', 'Cursos@actualizar')->name('actualizarCurso');



Route::get('exportDiarioBanco/{mes}/{ano}', 'Caixa@exportDiarioBanco')->name('exportDiarioBanco');
Route::get('exportPauta/{id}', 'Pautas@exportPauta')->name('exportPauta');
Route::get('registroPrimario', 'Candidatos@exportRegistroPrimario')->name('exportRegistroPrimario');
Route::get('aproveitamento', 'Estudantes@exportAproveitamento')->name('exportAproveitamento');



//inscricoes

Route::get('inscricoes', 'Estudantes@inscricoesPrincipal')->name('inscricoes');
Route::get('inscricoesEstudante/{id}', 'Estudantes@inscricoesEstudante')->name('inscricoesEstudante');
Route::get('inscricoesAtrasoEstudante/{id}', 'Estudantes@inscricoesAtrasoEstudante')->name('inscricoesAtrasoEstudante');

Route::get('turmas/obterCurso/{id}', 'Cursos@obterCurso')->name('obterCurso');

//Estudantes

Route::get('buscarFicha', 'Estudantes@buscarFicha')->name('buscarFicha');
Route::get('mostrarFichaEstudante/{email}', 'Estudantes@mostrarFichaEstudante')->name('mostrarFichaEstudante');

Route::get('disciplinas/{tuma}/{ano}/{sem}', 'Disciplinas@obterDisciplinas');
Route::get('disciplinasCurso/{curso}', 'Disciplinas@obterJsonDisciplinasCurso');
Route::get('obterProfessor/{idDisc}', 'Professores@obterProfessor');
Route::get('getJsonEstudante/{id}', 'Estudantes@getJsonEstudante');




Route::get('getJsonPagamentosTemp/{id}', 'Caixa@getJsonPagamentosTemp');

Route::get('eliminar_pagamento_tmp/{id}', 'Caixa@eliminar_pagamento_tmp')->name('eliminar_pagamento_tmp');
Route::post('confirmar_pagamentos_tmp/{id}', 'Caixa@confirmar_pagamentos_tmp')->name('confirmar_pagamentos_tmp');






Route::any('obterInscricoes/{idDisc?}/{anoAcademico?}/{turma?}', 'Professores@obterInscricoes')->name('obterInscricoes');

Route::get('buscarConta', 'Caixa@buscarConta')->name('buscarConta');
Route::post('mostrarConta', 'Caixa@buscarConta')->name('mostrarConta');
Route::post('registrarPagamentoTemp', 'Caixa@registrarPagamentoTemp')->name('registrarPagamentoTemp');


Route::post('registrarEmolumentoTemp', 'Caixa@registrarEmolumentoPagamentoTemp')->name('registrarEmolumentoPagamentoTemp');







//FUNCIONARIOS
Route::get('indexFuncionarios', 'Funcionarios@index')->name('indexFuncionarios');
Route::get('inserirFuncionario', 'Funcionarios@inserir')->name('inserirFuncionario');
Route::post('store_funcionario', 'Funcionarios@store_funcionario')->name('store_funcionario');
Route::get('editar_funcionario/{id}', 'Funcionarios@editar')->name('editar_funcionario');
Route::get('mapa_salarios', 'Funcionarios@mapa_salarios')->name('mapa_salarios');
Route::post('update_funcionario', 'Funcionarios@update_funcionario')->name('update_funcionario');
Route::get('eliminar_funcionario/{id}', 'Funcionarios@eliminar_funcionario')->name('eliminar_funcionario');


Route::get('eliminar_mapa_salarios/{id}', 'Funcionarios@eliminar_mapa_salarios')->name('eliminar_mapa_salarios');




//Funcionarios candidatos
Route::get('inserirFuncionario_candidato', 'Funcionarios@inserir_candidato')->name('inserirFuncionario_candidato');
Route::get('listarFuncionario_candidato', 'Funcionarios@listar_candidato')->name('listarFuncionario_candidato');
Route::get('mapa_ferias', 'Funcionarios@mapa_ferias')->name('mapa_ferias');
Route::post('store_feria', 'Funcionarios@store_feria')->name('store_feria');
Route::get('editar_ferias/{id}', 'Funcionarios@editar_ferias')->name('editar_ferias');

Route::post('store_candidato', 'Funcionarios@store_candidato')->name('store_candidato');

Route::get('contratar_candidato/{id}', 'Funcionarios@contratar_candidato')->name('contratar_candidato');
Route::get('editar_candidato/{id}', 'Funcionarios@editar_candidato')->name('editar_candidato');
Route::get('eliminar_candidato/{id}', 'Funcionarios@eliminar_candidato')->name('eliminar_candidato');



Route::get('presedencia/update','Disciplinas@presedenciaUpdate');//->name('actualizar_presedencia');
Route::get('presedencia/load','Disciplinas@presedenciaLoad');


Route::get('eliminar_precedencia/{id}', 'Disciplinas@eliminar_precedencia')->name('eliminar_precedencia');
Route::post('criar_mapa_salario', 'Funcionarios@mapa_salarios')->name('criar_mapa_salario');
Route::get('exportar_mapaPagamentos/{idMapa}', 'Funcionarios@exportar_mapa')->name('exportar_mapaPagamentos');
Route::get('exportar_mapaPagamentos_seg_social/{idMapa}', 'Funcionarios@exportar_mapa_seg_social')->name('exportar_mapa_seg_social');
Route::get('exportar_mapaPagamentos_irt/{idMapa}', 'Funcionarios@exportar_mapa_irt')->name('exportar_mapa_irt');
Route::post('index_mapas', 'Funcionarios@index_mapas')->name('index_mapas');





Route::get('mapas_salarios', 'Funcionarios@index_mapas_salarios')->name('index_mapas_salarios');
Route::get('registrar_mapa_salarios', 'Funcionarios@registrar_mapa_salarios')->name('registrar_mapa_salarios');
Route::post('store_mapa_salarios', 'Funcionarios@store_mapa_salarios')->name('store_mapa_salarios');
Route::get('mostrar_mapa/{id}', 'Funcionarios@mostrar_mapa')->name('mostrar_mapa');





Route::get('faltas/update','Funcionarios@faltasUpdate');//->name('actualizar_presedencia');
Route::get('faltas/load','Funcionarios@faltasLoad');

//subsidio Funcao
Route::get('subsidioFuncao/update','Funcionarios@subsidioFuncaoUpdate');//->name('actualizar_presedencia');
Route::get('subsidioFuncao/load','Funcionarios@subsidioFuncaoLoad');


//Grupos funcionarios

Route::get('index_grupos_funcionarios', 'Funcionarios@index_grupos_funcionarios')->name('index_grupos_funcionarios');
Route::get('registrar_grupo_funcionario', 'Funcionarios@registrar_grupo_funcionario')->name('registrar_grupo_funcionario');
Route::post('store_grupo_funcionario', 'Funcionarios@store_grupo_funcionario')->name('store_grupo_funcionario');
Route::get('editar_grupo_funcionario/{id}', 'Funcionarios@editar_grupo_funcionario')->name('editar_grupo_funcionario');
Route::post('update_grupo_funcionario', 'Funcionarios@update_grupo_funcionario')->name('update_grupo_funcionario');
Route::get('eliminar_grupo_funcionario/{id}', 'Funcionarios@eliminar_grupo_funcionario')->name('eliminar_grupo_funcionario');




//subsidios
Route::any('index_subsidios', 'Funcionarios@index_subsidios')->name('index_subsidios');
Route::get('eliminar_subsidio/{idFuncionario}/{idSubsidio}', 'Funcionarios@eliminar_subsidio')->name('eliminar_subsidio');
Route::post('registrar_subsidio', 'Funcionarios@registrar_subsidio')->name('registrar_subsidio');


//Tipos Contrato
Route::get('index_tipo_contrato', 'Tipos_contrato@index')->name('index_tipo_contrato');
Route::get('inserir_tipo_contrato', 'Tipos_contrato@inserir')->name('inserir_tipo_contrato');
Route::get('editar_tipo_contrato/{id}', 'Tipos_contrato@editar')->name('editar_tipo_contrato');
Route::get('eliminar_tipo_contrato/{id}', 'Tipos_contrato@eliminar')->name('eliminar_tipo_contrato');
Route::post('store_tipo_contrato', 'Tipos_contrato@store')->name('store_tipo_contrato');
Route::post('update_tipo_contrato', 'Tipos_contrato@update')->name('update_tipo_contrato');

//Habilitacoes Literarias
Route::get('index_hab_literarias', 'Hab_literarias@index')->name('index_hab_literarias');
Route::get('inserir_hab_literarias', 'Hab_literarias@inserir')->name('inserir_hab_literarias');
Route::get('editar_hab_literarias/{id}', 'Hab_literarias@editar')->name('editar_hab_literarias');
Route::get('eliminar_hab_literarias/{id}', 'Hab_literarias@eliminar')->name('eliminar_hab_literarias');
Route::post('store_hab_literarias', 'Hab_literarias@store')->name('store_hab_literarias');
Route::post('update_hab_literarias', 'Hab_literarias@update')->name('update_hab_literarias');
Route::get('add_hab_literaria/{idFunc}/{idHab}', 'Hab_literarias@add_hab_literaria')->name('add_hab_literaria');
Route::get('eliminar_hab_literaria/{idFunc}/{idHab}', 'Hab_literarias@eliminar_hab_literaria')->name('eliminar_hab_literaria');



//Documentos funcionarios
Route::get('index_documentos', 'Documentos_funcionarios@index')->name('index_documentos');
Route::get('inserir_documentos', 'Documentos_funcionarios@inserir')->name('inserir_documentos');
Route::get('editar_documentos/{id}', 'Documentos_funcionarios@editar')->name('editar_documentos');
Route::get('eliminar_documentos/{id}', 'Documentos_funcionarios@eliminar')->name('eliminar_documentos');
Route::post('store_documentos', 'Documentos_funcionarios@store')->name('store_documentos');
Route::post('update_documentos', 'Documentos_funcionarios@update')->name('update_documentos');
Route::get('add_documento/{idFunc}/{idDoc}', 'Documentos_funcionarios@add_documento')->name('add_documento');
Route::get('eliminar_documento/{idFunc}/{idDoc}', 'Documentos_funcionarios@eliminar_documento')->name('eliminar_documento');


//Linguas extr Ficha Funcionario
Route::get('index_lingua', 'Linguas@index')->name('index_lingua');
Route::get('inserir_lingua', 'Linguas@inserir')->name('inserir_lingua');
Route::get('editar_lingua/{id}', 'Linguas@editar')->name('editar_lingua');
Route::get('eliminar_lingua/{id}', 'Linguas@eliminar')->name('eliminar_lingua');
Route::post('store_lingua', 'Linguas@store')->name('store_lingua');
Route::post('update_lingua', 'Linguas@update')->name('update_lingua');
Route::get('add_idioma/{idFunc}/{idIdioma}', 'linguas@add_idioma')->name('add_idioma');
Route::get('eliminar_idioma/{idFunc}/{idIdioma}', 'linguas@eliminar_idioma')->name('eliminar_idioma');



//Usuarios
Route::get('perfil', 'Usuarios@perfil')->name('perfil');
Route::get('showChangePassword', 'Usuarios@showChangePassword')->name('showChangePassword');
Route::post('update_perfil', 'Usuarios@update_perfil')->name('update_perfil');
Route::post('update_password', 'Usuarios@update_password')->name('update_password');
Route::post('update_passwordFromAdmin', 'Usuarios@update_passwordFromAdmin')->name('update_passwordFromAdmin');




Route::get('obterDisciplinasAtraso/{curso_id}', 'Estudantes@obterDisciplinasAtraso')->name('obterDisciplinasAtraso');


Route::get('exameAdmissao/updateLocal','Candidatos@updateLocalExame');

Route::get('relatorios', 'Estudantes@relatorios')->name('relatorios');
Route::get('pdfEstRecEx3', 'Estudantes@pdfEstRecEx3')->name('pdfEstRecEx3');

Route::get('test_react', 'AdminController@test_react')->name('test_react');
Route::get('residencias', 'Pagamentos@pagamentosResidencia')->name('pagamentosResidencia');


//Categorias dos Livros

Route::get('listarCategoriasLivros', 'Categorias_livros@listarCategorias')->name('listarCategoriasLivros');
Route::get('addCategoriasLivros', 'Categorias_livros@addCategoria')->name('addCategoriaLivro');
Route::get('editarCategoriasLivros/{id}', 'Categorias_livros@editarCategoria')->name('editarCategoriaLivro');
Route::post('storeCategoriasLivros', 'Categorias_livros@store')->name('storeCategoriaLivro');
Route::post('updateCategoriasLivros', 'Categorias_livros@update')->name('updateCategoriaLivro');

Route::get('deleteCategoriasLivros/{id}', 'Categorias_livros@delete')->name('deleteCategoriaLivro');











//sumarios

Route::get('registrar_sumario/{prof_id}/{disc_id}', 'Sumarios@registrar_sumario')->name('registrar_sumario');
Route::post('save_sumario', 'Sumarios@save')->name('save_sumario');



Route::get('full-calender', 'FullCalenderController@index');
Route::any('full-calender/action', 'FullCalenderController@action');



Route::get('horarios', 'Horarios@index')->name('horarios');
Route::get('horarios/inserir', 'Horarios@inserir')->name('inserir_horario');
Route::post('horarios/save', 'Horarios@save')->name('save_horario');
Route::get('horarios/actividades/{horario}', 'Horarios@actividades')->name('horario-actividades');
Route::any('horarios/action', 'Horarios@action');


Route::get('professores_actividades/{id}', 'Horarios@professores_actividades')->name('professores_actividades');



Route::get('candidaturas2021', 'ProcessosCandidaturas@candidaturas2021')->name('candidaturas2021');
Route::get('matriculas2021', 'ProcessosCandidaturas@matriculas2021')->name('matriculas2021');




Route::post('formaPago/update', 'Facturas@actualizarFormaPago');


Route::get('declaracao', 'Estudantes@indexDeclaracao')->name('indexDeclaracao');
Route::post('gerarDeclaracao', 'Estudantes@gerarDeclaracao')->name('gerarDeclaracao');


Route::get('gerarDeclaracao', 'Estudantes@gerarDeclaracao')->name('gerarDeclaracao');

Route::get('eliminarExameCandidatura/{id}', 'Candidatos@eliminarExameCandidatura')->name('eliminarExameCandidatura');

            

Route::any('listasCandidatos', 'Candidatos@listasCandidatos')->name('listasCandidatos');

Route::get('listasCandidatosPdf/{curso}', 'Candidatos@listasCandidatosPdf')->name('listasCandidatosPdf');

Route::any('listarLivros', 'Livros@listarLivros')->name('listarLivros');
Route::get('registrarLivro', 'Livros@registrarLivro')->name('registrarLivro');
Route::post('storeLivro', 'Livros@storeLivro')->name('storeLivro');
Route::get('eliminarLivro/{id}', 'Livros@eliminarLivro')->name('eliminarLivro');
Route::get('actualizarLivro/{id}', 'Livros@actualizarLivro')->name('actualizarLivro');
Route::post('updateLivro', 'Livros@updateLivro')->name('updateLivro');


Route::get('aprovadosCurso/{id}', 'Pautas@aprovadosCurso')->name('aprovadosCurso');


Route::post('save_pagamento', 'Pagamentos@save_pagamento')->name('save_pagamento');

Route::get('cartao2/{id}', 'Estudantes@cartao')->name('cartao2');




Route::get('discAtrasso/{curso}', 'Estudantes@pdfListaDiscAtrasso')->name('listaEstudantesDiscAtrasso');



Route::get('indexUsuariosProfessores', 'Usuarios@usuariosProfessores')->name('indexUsuariosProfessores');


Route::get('exportListaCartao/{id}', 'Estudantes@exportListaCartao')->name('exportListaCartao');


Route::post('inscricoes/updateAno', 'Estudantes@updateAnoInscricoes')->name('updateAnoInscricoes');


Route::get('moduloMatriculas', 'Estudantes@moduloMatriculas')->name('moduloMatriculas');


Route::get('estudantes/teste', 'Estudantes@teste')->name('teste');


Route::get('pdfPagamentoCartao/{id}', 'Estudantes@pdfPagamentoCartao')->name('pdfPagamentoCartao');
