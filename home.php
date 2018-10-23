<!DOCTYPE html>
  <html lang="PT-BR">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">

    <title>GLF</title>
    
    <link rel="stylesheet" href="bootstrap/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bootstrap/dist/css/adminlte.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="bootstrap/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="bootstrap/plugins/morris/morris.css">
    <link rel="stylesheet" href="view/css/table.css">
  </head>

  <body class="hold-transition sidebar-mini">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="home.php" class="nav-link">Home</a>
          </li>
          <li>
            <a href="../sair.php" class="nav-link">Sair</a>
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="home.php" class="brand-link">
          <img src="#" alt="" class="brand-image img-rect elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">UFSC</span>
        </a>
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="#" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"></a>
            </div>
          </div>
          <button class="example2-2 btn btn-primary">EXEMPLO</button>
        </div>
      </aside>
      <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark"></h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"></li>
                </ol>
              </div>
            </div>
          </div>
        </div>
        <section class="content">
        <div class="row">
          <div class="col-md-12">
                <div class="card">
                <table class="tg">
                  <tr>
                    <th class="tg-wvxr"></th>
                    <th class="tg-5kju"></th>
                    <th class="tg-5kju"></th>
                    <th class="tg-5kju"></th>
                    <th class="tg-wvxr"></th>
                    <th class="tg-ir8p" rowspan="3"></th>
                    <th class="tg-iu89" rowspan="2"><span style="font-weight:bold;text-decoration:underline">Pag.</span><br><span style="font-weight:bold">1</span></th>
                  </tr>
                  <tr>
                    <td class="tg-xds7" colspan="2">DISCIPLINA AQUI</td>
                    <td class="tg-g5qm">NOME DA DISCIPLINA AQUI</td>
                    <td class="tg-8rb3" colspan="2">Turma: <span style="font-weight:bold">AQUI</span></td>
                  </tr>
                  <tr>
                    <td class="tg-vhpi">Ordem</td>
                    <td class="tg-4qi8"><span style="font-weight:bold">Matrícula</span></td>
                    <td class="tg-e7lt">Aluno</td>
                    <td class="tg-e7lt"> Nota</td>
                    <td class="tg-vhpi">Freq.</td>
                    <td class="tg-t2qg">Ordem</td>
                  </tr>
                  <tr>
                    <td class="tg-kvd6"></td>
                    <td class="tg-rqvj"></td>
                    <td class="tg-rqvj"></td>
                    <td class="tg-rqvj"></td>
                    <td class="tg-kvd6"></td>
                    <td class="tg-72fs"></td>
                    <td class="tg-kvd6"></td>
                  </tr>
                  <tr>
                    <td class="tg-iu89"></td>
                    <td class="tg-4qi8"></td>
                    <td class="tg-4qi8"></td>
                    <td class="tg-4qi8"></td>
                    <td class="tg-iu89"></td>
                    <td class="tg-ir8p"></td>
                    <td class="tg-iu89"></td>
                  </tr>
                </table>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
      <aside class="control-sidebar control-sidebar-dark">
      </aside>
      <footer class="main-footer">
        <div class="float-right d-sm-none d-md-block" style="font-size: .75rem;">
          "A imaginação é mais importante que o conhecimento." Einstein
        </div>
        <strong><a href="#">Feito por Deividhy Jr. Tonetti</a>.</strong>
      </footer>
    </div>
    <script src="bootstrap/plugins/jquery/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="bootstrap/dist/js/adminlte.js"></script>
    <script src="bootstrap/dist/js/demo.js"></script>
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>

    <script type="text/javascript">
        $('.example2-2').on('click', function () {
            $.confirm({
                title: 'Entre com seus dados',
                content: '' +
                '<form action="teste.php" class="formName">' +
                  '<div class="form-group">' +
                    '<label>Entre com seu SIAPE</label>' +
                    '<input type="text" class="name form-control" required="required" name="text" placeholder="SIAPE" pattern="[0-9]+$" />'+
                    '<label>Nome e Sobrenome</label>' +
                    '<input type="text" class="name form-control" required="required" name="text" placeholder="NOME" pattern="[a-z]+$" />'+
                    '<label>Entre com o horário das aulas e os dias</label><a href = "#" data-toggle="popover" title="Precisa de ajuda?" data-content="Some content inside the popover"><img src="https://png.icons8.com/metro/50/000000/question-mark.png" width = "20px" height = "20px"></a>' +
                    '<input type="text" class="name form-control" required="required" name="text" placeholder="NOME" pattern="[0-9]{5}-[0-9]{5}+$" /> '+
                    '<label>Entre com a data de início</label>' +
                    '<input type="date" placeholder="Data de ínicio" class="name form-control" required />' +
                    '<label>Entre com a data de fechamento</label>' +
                    '<input type="date" placeholder="Data de final" id = "teste" class="name form-control" required />' +
                  '</div>' +  
                '</form>',
                theme: 'modern',
                animation: 'scale',
                icon: 'fa fa-smile-o',
                type: 'green',
                buttons: {
                    formSubmit: {
                        text: 'Enviar',
                        btnClass: 'btn-blue',
                        action: function () {
                            var name = this.$content.find('.name').val();
                            var name1 = this.$content.find('#teste').val();
                            if (!name) {
                                $.alert('Data inválida');
                                return false;
                            }
                            $.alert('A data que ele entrou é:  ' + name + " DATA FIM: " + name1);
                        }
                    },
                    cancelar: function () {
                        //close
                    },
                },
                onContentReady: function () {
                    // you can bind to the form
                    var jc = this;
                    this.$content.find('form').on('submit', function (e) { // if the user submits the form by pressing enter in the field.
                        e.preventDefault();
                        jc.$$formSubmit.trigger('click'); // reference the button and click it
                    });
                }
            });
        });

        $(document).ready(function(){
          $('[data-toggle="popover"]').popover(); 
        });
    </script>
  </body>
</html>
