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
                '<form class="formName" action = "teste.php" id = teste  enctype="multipart/form-data">'+
                  '<div class="form-group">'+
                    '<label>Entre com seu SIAPE</label>'+
                    '<input type="text" class="name form-control" required="required" id = "siape" name="siape" placeholder="SIAPE" pattern="[0-9]+$" />'+
                    '<label>Nome e Sobrenome</label>'+
                    '<input type="text" class="name form-control" required="required" name="name" id = "name" placeholder="NOME" pattern="[a-z]+$" />'+
                    '<label>Entre com a data de início</label>'+
                    '<input type="date" placeholder="Data de ínicio" name = "date1" class="name form-control" id = "periodo1" required />'+
                    '<label>Entre com a data de fechamento</label>'+
                    '<input type="date" placeholder="Data de final" id = "periodo2" name = "date2" class="name form-control" required />'+
                    '<label>Arquivo .TXT</label>'+
                    '<input type="file" class="name form-control" name="fileUpload" id="file">'+
                    '<input type="hidden" name="importar" value="import">'+
                  '</div>'+  
                '</form>',
                theme: 'modern',
                animation: 'scale',
                icon: 'fa fa-smile-o',
                type: 'green',
                buttons: 
                {
                    formSubmit: 
                    {
                        text: 'Enviar',
                        btnClass: 'btn-blue',
                        action: function () 
                        {
                            let siape = this.$content.find('#siape').val();
                            let name = this.$content.find('#name').val();
                            let per1 = this.$content.find('#periodo1').val();
                            let per2 = this.$content.find('#periodo2').val();
                            let file = this.$content.find('#file').val();
                            
                            var form = $('form')[0]; 
                            var formData = new FormData(form);

                            if (!siape) 
                            {
                                $.alert('Siape inválido');
                                return false;
                            }

                            if (!name) 
                            {
                                $.alert('Nome inválida');
                                return false;
                            }

                            if (!per1) 
                            {
                                $.alert('Período inválido');
                                return false;
                            }

                            if (!per2) 
                            {
                                $.alert('Período inválido');
                                return false;
                            }

                            if (new Date(per1).getTime() >= new Date(per2).getTime()) 
                            {
                                $.alert('Perído inicial inválido');
                                return false;
                            }

                            if (!file) 
                            {
                                $.alert('Arquivo inválido');
                                return false;
                            }
                            else
                            {
                              $.ajax(
                              {
                                url: 'model/generator.php',
                                data: formData,
                                type: 'POST',
                                contentType: false, 
                                processData: false, 
                                
                                success: function(msg)
                                {
                                  $.confirm(
                                  {
                                    title: '<center>Escolha a disciplina!</center>',
                                    content: msg,
                                    type: 'blue',
                                    typeAnimated: true,
                                    theme: 'modern',
                                    animation: 'rotate',
                                    
                                    buttons: 
                                    {
                                        baixar: 
                                        {
                                            text: 'Baixar',
                                            btnClass: 'btn-blue',
                                            useBootstrap: true,
                                            animation: 'news',
                                            closeAnimation: 'news',
                                            content: 'url: model/generator.php',
                                            
                                            action: function()
                                            {
                                              var form = $('form')[0]; // You need to use standard javascript object here
                                              var formData = new FormData(form);

                                              $.ajax(
                                              {
                                                url: 'model/generator.php',
                                                data: formData,
                                                type: 'POST',
                                                contentType: false, 
                                                processData: false, 
                                                
                                                success: function(msg)
                                                { 
                                                  $.ajax(
                              {
                                url: 'model/generator.php',
                                data: formData,
                                type: 'POST',
                                contentType: false, 
                                processData: false, 
                                
                                success: function(msg)
                                {
                                                          $.confirm(
                                                          {
                                                            title: '<center>Teste!</center>',
                                                            content: msg,
                                                            type: 'blue',
                                                            typeAnimated: true,
                                                            theme: 'modern',
                                                            animation: 'rotate',
                                                            
                                                            buttons: 
                                                            {
                                                                baixar: 
                                                                {
                                                                    text: 'Baixar',
                                                                    btnClass: 'btn-blue',
                                                                    useBootstrap: true,
                                                                    animation: 'news',
                                                                    closeAnimation: 'news',
                                                                    content: 'url: model/generator.php',
                                                                    
                                                                    action: function()
                                                                    {
                                                                      var form = $('form')[0]; // You need to use standard javascript object here
                                                                      var formData = new FormData(form);

                                                                      $.ajax(
                                                                      {
                                                                        url: 'model/generator.php',
                                                                        data: formData,
                                                                        type: 'POST',
                                                                        contentType: false, 
                                                                        processData: false, 
                                                                        
                                                                        success: function(msg)
                                                                        { 
                                                                          console.log(msg);
                                                                        }
                                                                      });
                                                                    }
                                                                },
                                                                close: function () 
                                                                {

                                                                }
                                                            },
                                                            action: function()
                                                            {

                                                            }
                                                          });
                                                        }
                                                      });
                                                }
                                              });
                                            }
                                        },
                                        close: function () 
                                        {

                                        }
                                    },
                                    action: function()
                                    {

                                    }
                                  });
                                }
                              });
                            }                  
                        }
                    },
                    cancelar: function () 
                    {
                        //close
                    },
                },
            });
        });

        function mudarEstado0(el) 
        {
          var display = document.getElementById(el).style.display;
            
          if(document.getElementById('option0').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }

        function mudarEstado1(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option1').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }

        function mudarEstado2(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option2').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }

        function mudarEstado3(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option3').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }
        function mudarEstado4(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option4').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }
        function mudarEstado5(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option5').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }
        function mudarEstado6(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option6').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }
        function mudarEstado7(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option7').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }
        function mudarEstado8(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option8').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }
        function mudarEstado9(el) 
        {
          var display = document.getElementById(el).style.display;

          if(document.getElementById('option9').checked)
          {
              document.getElementById(el).style.display = 'block';
          }
          else
          {
            document.getElementById(el).style.display = 'none';
          }
        }      
    </script>
  </body>
</html>
