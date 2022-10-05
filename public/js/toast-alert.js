$(function() {
    window.onload = function() {
        if (document.getElementById('success')) {
            toastr.success('Ação realizada com sucesso.', 'Sucesso!', {
                progressBar: true,
                timeOut: 5000,
            });
        }
        if (document.getElementById('error')) {
            toastr.error('Ocorreu algum erro na sua ação.', 'Erro!', {
                progressBar: true,
                timeOut: 5000,
            });
        }
        if (document.getElementById('editado')) {
            toastr.success('Editado com sucesso.', 'Editado!', {
                progressBar: true,
                timeOut: 5000,
            });
        }
    }
});
