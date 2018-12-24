var semana = ["Domingo", "Segunda-Feira", "Terça-Feira", "Quarta-Feira", "Quinta-Feira", "Sexta-Feira", "Sábado"];
          
          $("input#dataR").blur(function()
          {
              var data = this.value;
              var arr = data.split("/").reverse();
              var teste = new Date(arr[0], arr[1] - 1, arr[2]);
              var dia = teste.getDay();
              alert(semana[dia]);
          });