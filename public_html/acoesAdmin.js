  function cadCategoria() {
      var categoria = $('#desc-categoria').val();
      var fxCad = $('#fxCad').val();

      if ((!categoria)) {
          $('#alertMsg').html('<h2>Por favor, preencha o campo</h2>');
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
      var genero = $('#genero').val();
      var fxCad = $('#fxCad').val();

      if ((!genero)) {
          $('#alertMsg2').html('<h2>Por favor, preencha o campo</h2>');
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
              if (result['status']) {
                  $('#alertMsg2').removeClass("error");
                  $('#alertMsg2').html(result.msg).addClass("sucess");
              } else {
                  $('#alertMsg2').html(result.msg).addClass("error");

              }
          })
  }