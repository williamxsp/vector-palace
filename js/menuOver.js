
$(document).ready(function(){
	//jQuery.preLoadImages("img/menu_inicial_over.png", "img/menu_noticias_hover.png", "img/menu_cadastro_over.png", "img/menu_fale_over.png", "img/menu_financeira_over.png", "img/menu_agenda_over.png");
	
	$("#menu_inicial").hover(
		function(){
			$(this).attr("src", "img/menu_inicial_over.png")	
		},
		function(){
			$(this).attr("src", "img/menu_inicial.png")
		}
		);
		
	$("#menu_noticias").hover(
		function(){
			$(this).attr("src", "img/menu_noticias_over.png")	
		},
		function(){
			$(this).attr("src", "img/menu_noticias.png")
		}
		);	
		
	$("#menu_cadastro").hover(
		function(){
			$(this).attr("src", "img/menu_cadastro_over.png")	
		},
		function(){
			$(this).attr("src", "img/menu_cadastro.png")
		}
		);	
		
	$("#menu_fale").hover(
		function(){
			$(this).attr("src", "img/menu_fale_over.png")	
		},
		function(){
			$(this).attr("src", "img/menu_fale.png")
		}
		);
		
	$("#menu_financeira").hover(
		function(){
			$(this).attr("src", "img/menu_financeira_over.png")	
		},
		function(){
			$(this).attr("src", "img/menu_financeira.png")
		}
		);
		
	$("#menu_agenda").hover(
		function(){
			$(this).attr("src", "img/menu_agenda_over.png")	
		},
		function(){
			$(this).attr("src", "img/menu_agenda.png")
		}
		);

		
});
