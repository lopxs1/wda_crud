			<hr>
		</main> <!-- /container -->
	</body>
	<footer class="container-fluid bg-dark p-3 text-center mt-2">
		<?php $data = new Datetime("now", new DateTimeZone("America/Sao_Paulo")) ?>
		<p class="text-light">&copy;2025 - <?php echo $data->format("Y"); ?>  - Gustavo & Renan</p>
	</footer>
	<script src="<?php echo BASEURL; ?>js/jquery-3.7.1.js"></script>
	<script src="<?php echo BASEURL; ?>js/fontawesome/all.min.js"></script>
	<script src="<?php echo BASEURL; ?>js/bootstrap/bootstrap.bundle.min.js"></script>
	<script src="<?php echo BASEURL; ?>js/main.js"></script>
</html>