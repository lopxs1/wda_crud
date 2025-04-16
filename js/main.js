/**
 * Passa os dados do cliente para o Modal, e atualiza o link para exclusão
 */
$('#delete-modal').on('show.bs.modal', function (event) {
  
	var button = $(event.relatedTarget);
	var id = button.data('customer');
  
	var modal = $(this);
	modal.find('.modal-title').text('Excluir Imóvel: ' + id);
	modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

$('#delete-modal-user').on('show.bs.modal', function (event) {
  
	var button = $(event.relatedTarget);
	var id = button.data('usuario');
  
	var modal = $(this);
	modal.find('.modal-title').text('Excluir usuário: ' + id);
	modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})

$('#delete-modal-cliente').on('show.bs.modal', function (event) {
  
	var button = $(event.relatedTarget);
	var id = button.data('customer');
  
	var modal = $(this);
	modal.find('.modal-title').text('Excluir cliente: ' + id);
	modal.find('#confirm').attr('href', 'delete.php?id=' + id);
})