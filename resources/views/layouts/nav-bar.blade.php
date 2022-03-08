           <div class="navbar-default sidebar nav-custom" role="navigation">

               <div class="sidebar-nav navbar-collapse">
                   <ul class="nav" id="side-menu">
                       <li class="sidebar-search">
                           <div class="input-group custom-search-form">
                               <input type="text" class="form-control" placeholder="Search...">
                               <span class="input-group-btn">
                                   <button class="btn btn-default" type="button">
                                       <i class="fa fa-search"></i>
                                   </button>
                               </span>
                           </div>

                       </li>
                       <li>
                           <a href="{{route('home')}}"><i class="fa fa-home fa-3x"></i> Inicio</a>
                       </li>





                       @if(Auth::user()->hasRole('gestor'))
                       <li>
                           <a href="#"><i class="fas fa-coins fa-3x"></i> Pagamentos<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">
                               <li>
                                   <a href="{{route('propinasGeral')}}"><i class="fa fa-dollar fa-3x"></i>Consultar </a>
                               </li>
                               <li>
                                   <a href="{{route('pagamentosMes')}}"><i class="fa fa-dollar fa-3x"></i>Propinas</a>
                               </li>

                               <li>
                                   <a href="{{route('listarCandidaturas')}}"><i class="fa fa-dollar fa-3x"></i>Inscrições</a>
                               </li>
                               <li>
                                   <a href="{{route('listarMatriculas')}}"><i class="fa fa-dollar fa-3x"></i>Matriculas</a>
                               </li>

                           </ul>
                       </li>
                       <li>
                           <a href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Emolumentos<span class="fa arrow"></span></a>
                           <ul class="nav nav-second-level">

                               <!--   <li>
                                   <a href="{{route('indexPagamentos')}}"><i class="fa fa-money fa-fw"></i>Consultar</a>
                               </li>
        -->
                               <li>
                                   <a href="{{route('listarEmolumentos')}}"><i class="fa fa-tasks fa-3x"></i>Gerir</a>
                               </li>
                               <!--  <li>
                                   <a href="{{route('pagarEmolumento')}}"><i class="fa fa-file fa-fw"></i>Fazer Pagamento</a>
                               </li>
        -->
                           </ul>
                       </li>
                       <li>
                           <a href="{{route('indexTest')}}"><i class="fa fa-dollar fa-3x"></i>Orçamento</a>
                       </li>
                       <li>
                           <a href="{{route('indexDispesas')}}"><i class="fa fa-dollar fa-3x"></i>Dispesas</a>
                       </li>
                       <li>
                           <a href="{{route('pagamentosDia')}}"><i class="fa fa-dollar fa-3x"></i>Pagamentos do dia</a>
                       </li>
                       <li>
                           <a href="{{route('relatoriosPagamentos')}}"><i class="fa fa-dollar fa-3x"></i>Mapas de Pagamentos</a>
                       </li>
                       <li>
                           <a href="{{route('diarioCaixaNovo')}}"><i class="fa fa-dollar fa-3x"></i>Diarios Banco</a>
                       </li>

                       <li>
                           <a href="{{route('matriculadosPorCurso')}}"><i class="fa fa-dollar fa-3x"></i>Matriculados</a>
                       </li>
                       <li>
                           <a href="{{route('buscarConta')}}"><i class="fa fa-dollar fa-3x"></i>BuscarConta</a>
                       </li>



                       @endif
                       @if(Auth::user()->hasRole('Caixa'))
                       <li>
                           <a href="{{route('pagamentosResidencia')}}"><i class="fa fa-users  fa-3x"></i> Pagamentos Novo</a>
                       </li>
                       <li>
                           <a href="{{route('pagamentosMes')}}"><i class="fa fa-dollar fa-3x"></i>Pagamentos Propinas</a>
                       </li>
                       <li>
                           <a href="{{route('pagamentoEmolumento')}}"><i class="fa fa-dollar fa-3x"></i>Pagamentos Emolumentos</a>
                       </li>
                       <li>
                           <a href="{{route('pagamentosDia')}}"><i class="fa fa-dollar fa-3x"></i>Pagamentos do dia</a>
                       </li>

                       @endif


                       @if(Auth::user()->hasRole('admin'))
                       <li>
                           <a href="{{route('listarEstudantes')}}"><i class="fa fa-users fa-fw"></i>Estudantes</a>
                       </li>

                       <li>
                           <a href="{{route('listarDepartamentos')}}"><i class="fa fa-building fa-fw"></i>Departamentos</a>
                       </li>
                       <li>
                           <a href="{{route('listarUsuarios')}}"><i class="fa fa-users fa-fw"></i>Usuarios</a>
                       </li>
                       <li>
                           <a href="{{route('listarTiposUsuarios')}}"><i class="fa fa-users fa-fw"></i>Tipos Usuarios</a>
                       </li>
                       <li>
                           <a href="{{route('v_test')}}"><i class="fa fa-home fa-3x"></i> V Test</a>
                       </li>
                       <li>
                           <a href="{{route('test_react')}}"><i class="fa fa-users  fa-3x"></i> Test React</a>
                       </li>
                       <li>
                           <a href="{{route('pagamentosResidencia')}}"><i class="fa fa-users  fa-3x"></i> Pagamentos Residências</a>
                       </li>
                       <li>
                           <a href="{{route('moduloMatriculas')}}"><i class="fa fa-users  fa-3x"></i> Modulo Matriculas test</a>
                       </li>
                       @endif

                       @if(Auth::user()->hasRole('AreaAcademica') || Auth::user()->hasRole('Caixa') || Auth::user()->hasRole('gestorAreaAcademica') || Auth::user()->hasRole('admin'))
                       <li>
                           <a href="{{route('candidaturas2021')}}"><i class="fa fa-address-card-o  fa-3x"></i> Candidaturas 2021/2022</a>
                       </li>

                       <li>
                           <a href="{{route('pagamentosResidencia')}}"><i class="fa fa-address-card-o  fa-3x"></i> Pagamentos Teste</a>
                       </li>
                       <li>
                           <a href="{{route('matriculas2021')}}"><i class="fa fa-address-card-o  fa-3x"></i> Matriculas 2021/2022</a>
                       </li>
                       <li>
                           <a href="{{route('listarEstudantes')}}"><i class="fa fa-address-card-o  fa-3x"></i> Estudantes</a>
                       </li>
                       <li>
                           <a href="{{route('buscarFicha')}}"><i class="fa fa-address-card  fa-3x"></i> Fichas de Estudantes</a>
                       </li>
                       <li>
                           <a href="{{route('listaPautas')}}"><i class="fa fa-file-excel-o fa-3x"></i>Pautas</a>
                       </li>
                       <li>
                           <a href="{{route('estudantesMatriculados')}}"><i class="fa fa-user-plus fa-3x"></i> Estudantes Matriculados</a>
                       </li>
                       <li>
                           <a href="{{route('listarTurmas')}}"><i class="fa fa-users fa-3x"></i> Turmas</a>
                       </li>
                       <li>
                           <a href="{{route('estudantes-turmas')}}"><i class="fa fa-folder-o fa-3x"></i> Estudantes-Turmas</a>
                       </li>
                       <li>
                           <a href="{{route('index-professores')}}"><i class="fa fa-user-circle fa-3x"></i>Professores</a>
                       </li>
                       <li>
                           <a href="{{route('listarCursos')}}"><i class="fa fa-graduation-cap fa-3x"></i>Cursos</a>
                       </li>
                       <li>
                           <a href="{{route('listarDisciplinas')}}"><i class="fa fa-file-text fa-3x"></i>Unidades Curriculares</a>
                       </li>

                       <li>
                           <a href="{{route('inscricoes')}}"><i class="fa fa-building fa-3x"></i>Inscrições</a>
                       </li>
                       <li>
                           <a href="{{route('buscarConta')}}"><i class="fa fa-dollar fa-3x"></i>Contas</a>
                       </li>
                       <li>
                           <a href="{{route('relatorios')}}"><i class="fa fa-dollar fa-3x"></i>Relatorios</a>
                       </li>
                       <li>
                           <a href="{{route('indexDeclaracao')}}"><i class="fa fa-dollar fa-3x"></i>Declaraões</a>
                       </li>
                       <!-- <li>
                           <a href="{{route('disciplinas-professores')}}"><i class="fa fa-building fa-3x"></i>Disciplinas-Professores</a>
                       </li>-->
                       <!--  <li>
                           <a href="{{route('exportDiarioBanco',[1,2021])}}"><i class="fa fa-building fa-3x"></i>Horarios</a>
                       </li>-->

                       <li>
                           <a href="{{route('listar_todos')}}"><i class="fa fa-building fa-3x"></i>Processos Candidaturas</a>
                       </li>
                       <li>
                           <a href="{{route('indexUsuariosProfessores')}}"><i class="fa fa-dollar fa-3x"></i>Usuarios professores</a>
                       </li>



                       @endif

                       @if(Auth::user()->hasRole('Patrimonio'))
                       <li>
                           <a href="{{route('index-consumiveis')}}"><i class="fa fa-users fa-3x"></i>Consumiveis</a>
                       </li>
                       <li>
                           <a href="{{route('listarEntradas')}}"><i class="fa fa-users fa-3x"></i>Entradas</a>
                       </li>
                       <li>
                           <a href="{{route('listarSaidas')}}"><i class="fa fa-users fa-3x"></i>Saidas</a>
                       </li>
                       <li>
                           <a href="{{route('stock')}}"><i class="fa fa-users fa-3x"></i>Stock</a>
                       </li>
                       <li>
                           <a href="#"><i class="fa fa-users fa-3x"></i>Inventario</a>
                       </li>

                       @endif

                       @if(Auth::user()->hasRole('professor'))
                       <li>
                           <a href="{{route('disciplinas-professores',Auth::user()->email)}}"><i class="fa fa-users fa-3x"></i>Unidades Curriculares</a>
                       </li>
                       <!--  <li>
                           <a href="{{route('examesAdmissao')}}"><i class="fa fa-users fa-3x"></i>Exames de Admissão</a>
                       </li>-->
                       @endif
                       @if(Auth::user()->hasRole('RH'))

                       <li>
                           <a href="{{route('indexFuncionarios')}}"><i class="fa fa-users fa-3x"></i>Funcionarios</a>
                       </li>
                       <li>
                           <a href="{{route('index-professores')}}"><i class="fa fa-users fa-3x"></i>Professores</a>
                       </li>
                       <li>
                           <a href="{{route('index_mapas_salarios')}}"><i class="fa fa-money fa-3x"></i> Mapa de Salarios</a>
                       </li>
                       <li>
                           <a href="{{route('mapa_ferias')}}"><i class="fa fa-calendar-o fa-3x"></i> Mapa de Ferias</a>
                       </li>
                       <li>
                           <a href="#"><i class="fa fa-road fa-3x"></i>Assiduidade</a>
                       </li>
                       <li>
                           <a href="{{route('index_subsidios')}}"><i class="fa fa-credit-card fa-3x"></i> Subsidios</a>
                       </li>
                       <li>
                           <a href="{{route('index_grupos_funcionarios')}}"><i class="fa fa-users fa-3x"></i>Grupos de Funcionarios</a>
                       </li>
                       <li>
                           <a href="{{route('index_documentos')}}"><i class="fa fa-file-text fa-3x"></i> Documentos</a>
                       </li>
                       <li>
                           <a href="{{route('index_tipo_contrato')}}"><i class="fa fa-pencil-square-o fa-3x"></i>Tipos de Contratos</a>
                       </li>
                       <li>
                           <a href="{{route('index_hab_literarias')}}"><i class="fa fa-mortar-board fa-3x"></i>Habilitações Literarias</a>
                       </li>
                       <li>
                           <a href="{{route('index_lingua')}}"><i class="fa fa-language fa-3x"></i> Idiomas</a>
                       </li>
                       <li>
                           <a href="{{route('listarFuncionario_candidato')}}"><i class="fa fa-users fa-3x"></i>Candidatos</a>
                       </li>


                       @endif
                       @if(Auth::user()->hasRole('Estudante'))
                       <li>
                           <a href="{{route('mostrarFichaEstudante',Auth::user()->email)}}"><i class="fa fa-users fa-3x"></i>Ficha Acadêmica</a>
                       </li>

                       @endif
                       @if(Auth::user()->hasRole('DirectorAreaAcademica') || Auth::user()->hasRole('DirectorGeral'))
                       <li>
                           <a href="{{route('candidaturas2021')}}"><i class="fa fa-address-card-o  fa-3x"></i> Candidaturas 2021/2022</a>
                       </li>
                       <li>
                           <a href="{{route('listarEstudantes')}}"><i class="fa fa-address-card-o  fa-3x"></i> Estudantes</a>
                       </li>
                       <li>
                           <a href="{{route('listarTurmas')}}"><i class="fa fa-users fa-3x"></i> Turmas</a>
                       </li>
                       <li>
                           <a href="{{route('estudantes-turmas')}}"><i class="fa fa-folder-o fa-3x"></i> Estudantes-Turmas</a>
                       </li>
                       <li>
                           <a href="{{route('index-professores')}}"><i class="fa fa-user-circle fa-3x"></i>Professores</a>
                       </li>
                       <li>
                           <a href="{{route('listarCursos')}}"><i class="fa fa-graduation-cap fa-3x"></i>Cursos</a>
                       </li>
                       <li>
                           <a href="{{route('listarDisciplinas')}}"><i class="fa fa-file-text fa-3x"></i>Unidades Curriculares</a>
                       </li>
                       <li>
                           <a href="{{route('listaPautas')}}"><i class="fa fa-file-excel-o fa-3x"></i>Pautas</a>
                       </li>
                       <li>
                           <a href="{{route('inscricoes')}}"><i class="fa fa-pencil-square-o fa-3x"></i>Inscrições</a>
                       </li>
                       <li>
                           <a href="{{route('buscarFicha')}}"><i class="fa fa-address-card  fa-3x"></i> Fichas de Estudantes</a>
                       </li>
                       <li>
                           <a href="{{route('horarios')}}"><i class="fa fa-address-card  fa-3x"></i> Horarios</a>
                       </li>

                       <li>
                           <a href="{{route('listar_todos')}}"><i class="fa fa-folder-open-o  fa-3x"></i> Processos candidaturas</a>
                       </li>




                       @endif
                       @if(Auth::user()->hasRole('GestorExamesAcesso'))
                       <li>
                           <a href="{{route('listar_todos')}}"><i class="fa fa-folder-open-o  fa-3x"></i> Processos candidaturas</a>
                       </li>
                       @endif
                       @if(Auth::user()->hasRole('Bibliotecario'))
                       <li>
                           <a href="{{route('listarLivros')}}"><i class="fa fa-folder-open-o  fa-3x"></i> Livros</a>
                       </li>
                       <li>
                           <a href="{{route('listarCategoriasLivros')}}"><i class="fa fa-folder-open-o  fa-3x"></i> Categorias</a>
                       </li>
                       @endif
                   </ul>
               </div>
               <!-- /.sidebar-collapse -->
           </div>
           <!-- /.navbar-static-side -->
           <!-- </nav>-->