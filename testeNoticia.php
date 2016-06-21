<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/base.dwt.php" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- InstanceBeginEditable name="doctitle" -->
<title>:: Vector Palace ::</title>
<!-- InstanceEndEditable -->
<link rel="stylesheet" type="text/css" href="css/geral.css"/>
<!-- InstanceBeginEditable name="head" -->

<script type="text/javascript" src="js/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- InstanceEndEditable -->
</head>

<body>


  <div id="geral">
  	<div id="topo">
    	<div id="logo">
			<h1><a href="home.php">Vector Palace</a></h1>
			<a href="home.php"><img src="img/logo.png" alt="Vector Palace" title="Clique para voltar para a página inicial" /></a>
        </div><!-- Logo -->
    </div><!-- topo -->
    
    <div id="menu"><ul><li><a href="home.php"><img src="img/menu_inicial.png" alt="Início" title="Voltar para a página inicial" /></a></li><li><a href="noticias.php"><img src="img/menu_noticias.png" alt="Notícias de Condomínio" title="Ver as notícias" /></a></li><li><a href="meuCadastro.php"><img src="img/menu_cadastro.png" alt="Meu Cadastro" title="Editar o seu perfil" /></a></li><li><a href="faleConosco.php"><img src="img/menu_fale.png" alt="Fale Conosco" title="Entre em contato" /></a></li><li><a href="financeiro.php"><img src="img/menu_financeira.png" alt="Situação Financeira" title="Veja a sua situação financeira" /></a></li><li><a href="agenda.php"><img src="img/menu_agenda.png" alt="Agenda" title="Veja os próximos eventos" /></a></li></ul></div><!-- menu -->
	<div id="conteudo_topo"></div>
    <div id="conteudo">
    <!-- InstanceBeginEditable name="conteudo" -->
    <form method="post" action="exibeConteudo.php" id="editorConteudo">
    <label for="tituloNoticia">
    	<input type="text" name="tituloNoticia" id="tituloNoticia" value="Digite o Título Aqui" onclick="javascript:if(this.value == 'Digite o Título Aqui'){this.value=''}" onblur="javascript:if(this.value=''){this.value='Digite o Título Aqui'}"/>
    </label>
		<textarea id="textoNoticia" name="textoNoticia" rows="30" cols="80" style="width:100%">
		</textarea>
		<input type="submit" name="save" value="Salvar" />
		<input type="reset" name="reset" value="Apagar" />
	</form>

	
	<!-- InstanceEndEditable -->		
        <div class="ajuste"></div><!--Descer o fundo, float sucks -->
    </div><!-- #conteudo -->

	<div id="conteudo_base"></div>         
    <div id="footer">
        	<div id="info">
            	Condomínio de luxo - <strong>2011</strong>
            </div>
            <div id="creditos">
            	Desenvolvido por: Lets Do <strong>IT</strong>
            </div>
        </div><!--footer -->
  </div><!-- geral -->
</body>
<!-- InstanceEnd --></html>