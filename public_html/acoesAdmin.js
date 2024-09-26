  function cadCategoria() {
      var categoria = $('#desc-categoria').val();
      var fxCad = $('#fxCad').val();

      if ((!categoria)) {
          $('#alertMsg').html('<h2>Por favor, preencha o campo front</h2>');
          $('#desc-categoria').focus();
          return;
      }

      $.ajax({
              url: "../private/controller/Admin.controller.php",
              method: "POST",
              async: true,
              data: {
                  categoria: categoria,
                  fxCad: fxCad,
              }
          })

          .done(function (result) {
              if (result['status']) {
                  $('#alertMsg').removeClass("error");
                  $('#alertMsg').html(result.msg).addClass("sucess");
              } else {
                  $('#alertMsg').html(result.msg).addClass("error");

              }
          })
  }


  function cadGenero() {
      var genero = $('#desc-genero').val();
      var fxCad = $('#fxCad2').val();

      if (!genero) {
          $('#alertMsg2').html('<h2>Por favor, preencha o campo front</h2>');
          $('#genero').focus();
          return;
      }

      $.ajax({
              url: "../private/controller/Admin.controller.php",
              method: "POST",
              async: true,
              data: {
                  genero: genero,
                  fxCad: fxCad,
              }
          })
          .done(function (result) {
              console.log("Resultado da requisição:", result); // Log para ver a resposta
              if (result['status']) {
                  $('#alertMsg2').removeClass("error");
                  $('#alertMsg2').html(result.msg).addClass("success");
              } else {
                  $('#alertMsg2').html(result.msg).addClass("error");
              }
          });
          
  }

   function cadEtaria() {
      var etaria = $('#desc-etaria').val();
      var fxCad = $('#fxCad3').val();

      if (!genero) {
          $('#alertMsg2').html('<h2>Por favor, preencha o campo front</h2>');
          $('#genero').focus();
          return;
      }

      $.ajax({
              url: "../private/controller/Admin.controller.php",
              method: "POST",
              async: true,
              data: {
                  etaria: etaria,
                  fxCad: fxCad,
              }
          })
          .done(function (result) {
              console.log("Resultado da requisição:", result); // Log para ver a resposta
              if (result['status']) {
                  $('#alertMsg2').removeClass("error");
                  $('#alertMsg2').html(result.msg).addClass("success");
              } else {
                  $('#alertMsg2').html(result.msg).addClass("error");
              }
          });
          
  }

  function cadMidia() {
      var titulo = $('#tituloMidia').val();
       var sel_genero = $('#genero').val();
       var sel_categoria = $('#categoria').val();
       var sel_etaria = $('#etaria').val();
      var fxCad = $('#fxCad4').val();

      if (!genero) {
          $('#alertMsg2').html('<h2>Por favor, preencha o campo front</h2>');
          $('#genero').focus();
          return;
      }

      $.ajax({
              url: "../private/controller/Admin.controller.php",
              method: "POST",
              async: true,
              data: {
                titulo: titulo,
                sel_genero: sel_genero,
                sel_categoria: sel_categoria,
                sel_etaria: sel_etaria,
                fxCad: fxCad,
              }
          })
          .done(function (result) {
              console.log("Resultado da requisição:", result); // Log para ver a resposta
              if (result['status']) {
                  $('#alertMsg2').removeClass("error");
                  $('#alertMsg2').html(result.msg).addClass("success");
              } else {
                  $('#alertMsg2').html(result.msg).addClass("error");
              }
          });
          
  }

 