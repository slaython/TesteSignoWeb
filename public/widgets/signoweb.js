$(document).ready(function() {

    let BASE = $('meta[name="base"]').attr('content');

	//DEFINE HEADERS DO AJAX
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

    //CADASTRO DE ENQUETES
    $('form[name="FormCadastroEnquete"]').submit(function(event){
        event.preventDefault();
        const action = $(this).attr('action');
        const Form = $(this);
        //SUBMIT DO FORMULÁRIO COM AJAX
        Form.ajaxSubmit({
            url: action,
            type: 'POST',
            dataType: 'json',
            beforeSubmit: function() {},
            uploadProgress: function(evento, posicao, total, completo) {},
            success: function(res){
                console.log('deu certo');
                if(res.resposta.data.insert === true){
                    //FECHA MODAL
                    $('#modalFormCadastroEnquete').modal('hide');
                }
                //MONTA TOAST E EXIBE USANDO A FUNCÃO
                if(res.resposta.toast) {
                    ToastPresent(
                        res.resposta.toast.mensagem,
                        res.resposta.toast.classe,
                        res.resposta.icone,
                        5000
                    );
                }
                //ADICIONA HTML
                // if(res.resposta.data.html_enquete){
                //     $('.js_enquete_add').prepend(res.resposta.data.html_enquete);
                // }
            },
            error: function(){
                console.log('deu errado');
                //FECHA LOADING
                $('.ub-loading').fadeOut(5000);
                ToastPresent(
                    'Ocorreu uma falha na conexão, atualize página e tente novamente...',
                    'error',
                    'icon',
                    15000
                );
            }
        })
    });

    //VOTACAO
    $('form[name="FormVotacao"]').submit(function(event){
        event.preventDefault();

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Tem certeza?',
            text: "Você não será capaz de reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Confirmar voto!',
            cancelButtonText: 'Cancelar voto!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const action = $(this).attr('action');
                const Form = $(this);
                //SUBMIT DO FORMULÁRIO COM AJAX
                Form.ajaxSubmit({
                    url: action,
                    type: 'POST',
                    dataType: 'json',
                    beforeSubmit: function() {},
                    uploadProgress: function(evento, posicao, total, completo) {},
                    success: function(res){
                        console.log('deu certo');
                        if(res.resposta.data.insert === false){
                            if(res.resposta.toast) {
                                ToastPresent(
                                    res.resposta.toast.mensagem,
                                    res.resposta.toast.classe,
                                    res.resposta.icone,
                                    5000
                                );
                            }
                        }
                        if(res.resposta.data.insert === true){
                            swalWithBootstrapButtons.fire(
                            'Confirmado!',
                            'Seu voto foi contabilizado.',
                            'success'
                            )
                            //REDIRECIONA
                            if(res.resposta.redirect) {
                                setTimeout(function(){
                                    window.location.href = res.resposta.redirect;
                                }, 1000);
                            }
                        }
                    },
                    error: function(){
                        console.log('deu errado');
                        //FECHA LOADING
                        $('.ub-loading').fadeOut(5000);
                        ToastPresent(
                            'Ocorreu uma falha na conexão, atualize página e tente novamente...',
                            'error',
                            'icon',
                            15000
                        );
                    }
                })
            } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelado',
                'Seu voto não foi contabilizado.',
                'error'
                )
            }
        }) 
    });

    //MASCARAS
    $(".js-mask-data").mask("00/00/0000");

});

/*
	FUNCÕES DE HELPER
*/
function ToastPresent(mensagem, classe, icone, duracao){
	toastr.options = {
       "closeButton": false,
       "debug": true,
       "newestOnTop": true,
       "progressBar": false,
       "positionClass": "toast-top-center",
       "preventDuplicates": false,
       "onclick": null,
       "showDuration": "1000",
       "hideDuration": "1000",
       "timeOut": duracao,
       "extendedTimeOut": "1000",
       "showEasing": "swing",
       "hideEasing": "linear",
       "showMethod": "slideDown",
       "hideMethod": "slideUp"
   }
   toastr[classe](mensagem);
}


