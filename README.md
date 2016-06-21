# Vector Palace
Projeto realizado em 2011 para conclusão do curso técnico em informática e redes de computadores

# Web Site

# O projeto

O website vector palace se propõe à disponibilizar serviços e informações aos moradores do conjunto residencial.

Os usuários poderão ler e cadastrar notícias, ver a previsão do tempo, editar suas informações cadastrais, ver se existe alguma taxa de condomínio pendente e se existir, gerar o boleto de acordo com o banco de sua preferência. Também poderá entrar em contato com os responsáveis pelo complexo além de poder personalizar a sua página escolhendo o tema que mais lhe agrade. 

# Público Alvo

Nosso público alvo consiste de executivos de alto padrão, que moram no Oriente Médio e estão no Brasil à trabalho. Em função disso foi será desenvolvido um website que seja rápido, leve e fácil de usar. Veremos na seção tema, como o público alvo influenciou na aparência do website.

# Estrutura de Arquivos

Para facilitar e agilizar a manutenção do website, organizamos os arquivos em pastas de acordo com sua funcionalidade:

**Core
**Arquivos excênciais para o funcionamento do sistema

**Classes**
Arquivos de classe, onde cada arquivo representa uma entidade dentro do sistema (noticia, cobrança, usuário)

**Includes**
Arquivos que serão incluídos dentro de várias páginas (topo, rodapé)

**Img**
Imagens que estão dentro do website. Algumas imagens foram adicionadas em outras subpastas para melhor organização. Por exemplo  as imagens que serão enviadas pelos usuários ao cadastrar uma nova notícia estão na pasta upload.

**Temas**
Os temas que os usuários poderão utilizar. Dentro dessa pasta haverá uma para cada tema com seus arquivos.

 

# Nomenclatura

Por estarmos utilizando como linguagem de desenvolvimento PHP que é case sensitive, adotamos uma nomenclatura para o nome de arquivos. Utilizaremos o lowerCameCase, que consiste em escrever o nome dos arquivos sem espaços, onde cada palavra é iniciada com maiúsculas menos a primeira que é escrita em minúscula.

Para classes utilizamos o padrão:

nomeDaClasse**.class.php**

# Mapa do Site

**Notícias do Condomínio
**Nessa página o usuário terá acesso as notícias que foram cadastradas e também poderá cadastrar novas notícias. Ao cadastrar uma nova, esta estará sujeita a aprovação do administrador antes de ser exibida.

**Meu Cadastro
**Aqui o usuário poderá editar suas informações cadastrais como por exemplo seu telefone e trocar sua senha.

**Fale Conosco
**Essa página apesar de não ter sido requisitada, foi incluída por ser mais um canal de comunicação entre a empresa responsável pelo complexo e os condôminos. Nela haverá um formulário onde os usuários poderão entrar em contato com a empresa.

**Situação Financeira
**Na página situação financeira o condômino poderá visualizar as taxas pendentes assim como as que já foram pagas, e emitir seu boleto. O boleto será emitido de acordo com o banco que ele escolheu. A escolha do banco preferencial também é feito nessa página.

As taxas não pagas terão 3 status diferentes: 

* Atrasado (quando a data de vencimento já passou)

* Aviso (quando faltam dois dias para vencer)

* Ok (Quando faltam mais de dois dias para vencer)

**Agenda**
Aqui foi uma sugestão da Lets Do It. Teremos eventos que serão cadastrados pelos administradores.

**Funções Administrativas
**Esse é um grupo de páginas que só poderá ser acessado quando o usuário logado tiver perfil de administrador.

**Gerenciar Notícias
**Editar, aprovar e editar notícias cadastradas.

**Gerenciar Usuários
**Editar, excluir e adicionar usuários.

**Gerenciar Cobranças
**Editar, excluir e adicionar cobranças.

**Gerenciar Administradores**
Editar, excluir e adicionar administradores

# DER (Diagrama Entidade-Relacionamento)

No diagrama abaixo mostramos como as tabelas do banco de dados serão relacionadas.

# Wireframe

Essa etapa tem como objetivo planejar o posicionamento dos elementos que irão compor as páginas. Além disso foi requisitado pelo cliente que na página inicial do website mostrasse as 5 últimas notícias cadastradas, cobranças em atraso do usuário atual e a previsão do tempo.

Vejamos a baixo como ficou o desenho da página principal:


# Layout  Padrão

Esse é o layout que o usuário tem por padrão ao efetuar login pela primeira vez no sistema.

#

# Design

Em função do público alvo, procuramos na arquitetura do oriente médio elementos para colocarmos dentro do website. Alguns aspectos interessantes que encontramos foi o uso da simetria que é bastante apreciado naquela região, cores quentes e fortes além das  grandes construções, com bastante espaço livre.

Como podemos notar na imagem anterior, todas esses aspectos podem ser encontrados sem perder na funcionalidade, navegação e usabilidade do website.

# Temas

Como requisitado pelo cliente, foram desenvolvidos outros 4 temas além do padrão.

**Verde

**Azul

**Rosa

**Preto

# Interações do cliente

Os usuários poderão  utilizar os seguintes recursos do website:

* Recuperar senha

* Ler notícias

* Cadastrar notícias (esta deverá ser aprovada pelo administrador antes de ser exibida)

* Editar suas informações cadastrais

* Receber ou não as notícias que são aprovadas por email

* Escolher qual tema deseja utilizar

* Visualizar taxas de condomínio não pagas

* Visualizar taxas de condomínio pagas

* Escolher em qual banco deseja pagar suas taxas

* Gerar boletos referentes às taxas

Abaixo teremos imagens exibindo cada um desses recursos:

**Recuperar

O usuário deverá digitar seu CPF e então receberá uma nova senha por email. Optamos por trocar a senha do cliente ao invés de simplesmente enviá-la por email para aumentar a segurança do sistema, visto que as criptografias que possibilitam a recuperação de senhas são muito ineficientes.

**Ler

**Cadastrar Notícias

**Editar Suas Informações, receber notícias por email e escolher

**Situação

**Boleto Bancário

# Interações do administrador

Quando um usuário estiver logado com perfil de administrador, no topo da página aparecerá um menu com recursos administrativos, nela estarão as opções para:

* Gerenciar Usuários

* Gerenciar Cobranças

* Gerenciar Notícias

* Gerenciar Administradores

**Gerenciar Notícias

**Gerenciar Cobranças



