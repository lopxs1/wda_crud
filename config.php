<?php
	/** O nome do banco de dados*/
	define("DB_NAME", "wda_crud");

	/** Usuário do banco de dados MySQL */
	define("DB_USER", "root");

	/** Senha do banco de dados MySQL */
	define("DB_PASSWORD", "");

	/** nome do host do MySQL Localhost */
	define("DB_HOST", "");

	/** caminho absoluto para a pasta do sistema **/
	if ( !defined("ABSPATH") )
		define("ABSPATH", dirname(__FILE__) . "/");
		
	/** caminho no server para o sistema **/
	if (!defined("BASEURL")) {
		define("BASEURL", "/wda_crud/");
	}	
		
	/** caminho do arquivo de banco de dados **/
	if ( !defined("DBAPI") )
		define("DBAPI", ABSPATH . "inc/database.php");

	/** caminhos dos templates de header e footer **/
	define("HEADER_TEMPLATE", ABSPATH . "inc/header.php");
	define("FOOTER_TEMPLATE", ABSPATH . "inc/footer.php");

	//Caminhos da classe pdf
	define("PDF", ABSPATH . "inc/pdf.php");

	/** caminhos para o modal do cookie **/
	define ("COOKIE_TEMPLATE", ABSPATH . "inc/cookiemodal.php");
?>