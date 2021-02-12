$(document).ready(() => {
    /**
     * Requisição simples para back-end usar o load(), get() ou post
     * 
     */
    $('#documentacao').on('click', () => {
        // usando get(), post()funciona da mesma forma
        $.get('documentacao.html', data => {
            $('#pagina').html(data)
        })
    })

    $('#suporte').on('click', () => {
        // usando o método load()
        $('#pagina').load('suporte.html')
    })

    $('#home').on('click', () => {
        $.post('index.html', data => {
            $(body).html(data)
        })
    })
    /**Final de requisição simples */


    // Comunicação com o backend da aplicação usando ajax
    $('#competencia').on('change', e => {

        let competencia = $(e.target).val()
        $.ajax({
            type: 'GET', // type o tipo de requisição POST ou GET
            url: '../../app/app.php', // url arquivo a ser chamado para requisição
            data: `competencia=${competencia}`, // data os dados a serem passados para backend para passar mais de um basta separar por &
            dataType: 'json', // configurar o tipo de dado recebido pela requisição
            success: dados => {
                $('#numeroVenda').html(dados.numeroVendas)
                $('#totalVendas').html(dados.totalVendas)
                $('#clienteAtivo').html(dados.clientesAtivos)
                $('#clienteInativo').html(dados.clientesInativos)
                $('#reclamacao').html(dados.totalReclamacao)
                $('#elogio').html(dados.totalElogio)
                $('#sugestao').html(dados.totalSugestao)
                $('#totalDespesa').html(dados.totalDespesa)
            }, // caso tenho sucesso retorna os dados da requisição
            error: erro => {console.log(erro)}
        })
    })
})