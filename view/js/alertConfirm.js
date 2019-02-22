$('.example2-2').on('click', function () 
{
    $.confirm(
    {
        title: 'Entre com seus dados',
        content: '' +
        '<form class="formName" enctype="multipart/form-data method = "POST" "><br>'+
          '<div class="container">'+     
            '<div class="name form-group">'+
              '<input type="text" class="name form-control" required="required" id = "siape" name="siape" pattern="[0-9]+$" />'+
              '<label class="name form-control-placeholder">Entre com seu SIAPE</label>'+
            '</div>'+
            '<div class="name form-group">'+
              '<input type="text" class="name form-control" required="required" name="name" id = "name" />'+
              '<label class="name form-control-placeholder">Nome e Sobrenome</label>'+                         
            '</div>'+
            '<div class="form-group">'+  
              '<label>Entre com a data de início</label>'+
              '<input type="date" placeholder="Data de ínicio" name = "date1" class="name form-control" id = "periodo1" required />'+
              '<label>Entre com a data de fechamento</label>'+
              '<input type="date" placeholder="Data de final" id = "periodo2" name = "date2" class="name form-control" required />'+
              '<label>Arquivo .TXT</label>'+
              '<input type="file" class="name form-control" name="fileUpload" id="file">'+
              '<input type="hidden" name="importar" value="import">'+
            '</div>'+
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
                method: 'POST',
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
                            method: 'POST',

                            buttons: 
                            {
                                baixar: 
                                {
                                    text: 'Baixar',
                                    btnClass: 'btn-blue',
                                    useBootstrap: true,
                                    animation: 'news',
                                    closeAnimation: 'news',
                                    content: 'url: model/generator.php?',
                                    
                                    action: function()
                                    {
                                      var form1 = $('form')[0]; 
                                      var formData1 = new FormData(form);
                                      
                                      let day1 = this.$content.find('#option1').val();
                                      let day2 = this.$content.find('#option2').val();
                                      let hour1 = this.$content.find('#option2').val();
                                      let hour2 = this.$content.find('#option2').val();

                                      
                                      /*
                                      if(2<3)
                                      {
                                        $.alert(
                                          {
                                            title: '<center>Ops! Informou a hora ERRADA</center>',
                                            content: "Para continuar é necessário informar a hora corretamente.",
                                            type: 'red',
                                            typeAnimated: true,
                                            theme: 'modern',
                                            animation: 'rotate',
                                            icon: 'fa fa-clock-o',
                                            
                                            action: function(msg)
                                            {
                                              return false;
                                            }
                                          });
                                      }*/
                                      
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
                                          window.location.href = msg;
                                          
                                          console.log (msg);
                                          
                                          $.alert(
                                          {
                                            title: '<center>Seu donwload está pronto</center>',
                                            content: '',
                                            typeAnimated: true,
                                            theme: 'supervan',
                                            animation: 'rotate',
                                            closeIcon: false,
                                            draggable: false,

                                            action: function(msg)
                                            {
                                              console.log(msg);
                                            }
                                          });
                                        },

                                        beforeSend : function() 
                                        {
                                            $.dialog(
                                            {
                                                title: '',
                                                content: ('<img src="view/img/pacman.svg" />'),
                                                theme: 'supervan',
                                                buttons: false,
                                                closeIcon: false,
                                                draggable: false
                                            })
                                          //$('body').append('<img src="view/img/pacman.svg" />');
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