## Lógica da troca de tema: 
no android studio, no onCreate da home_activity, 
chamar o código php pra verificar a data final dos temas na tabela debate 

Vai criar um array da tabela debate ordenando (com order by) pela data final, 
com a maior data primeiro (a data mais recente) e depois pega apenas o primeiro item 
da tabela que a consulta (select) retornou

Logo em seguida, comparar essa primeira data final com a data atual

Caso essa data final não tenha passado, ir para o Android Studio e colocar 
o tema referente a essa data na tela inicial

Caso já passou, pegar o primeiro tema da tabela tema/curtida ordenando 
pelos que tiverem mais votos (curtidas), levar ele pra tabela Debate, 
colocar a data inicial como a data atual (now) e já definir a data final

############################################################
☐ A fazer
☑ Feito
☒ Adiado

## Abriu a tela de login:
☑ Criptografar a senha que o usuário digitou quando comparar com a criptografada do banco
☑ Quando o usuário se cadastrar, criptograr a senha antes de mandar pro banco

## Abriu a tela inicial:
☐ Ver se o tema mais atual na tabela debate ainda está valido
☐ Se estiver, carregar ele no dropdown 
☐ Se não estiver válido, pegar o tema com mais curtidas e que não está associado a tabela debate

## Abriu a tela de votação:
☐ Consulta a Tabela Tema e faz um array com os temas que não tem um correspondente na Tabela Debate 
☐ Enquanto percorrer o array para preencher o RecyclerView com os temas, consultar com o id de cada tema 
a quantidade de curtidas que ele possui da Tabela Curtida **e** verificar se o usuário logado ja curtiu
esse tema (faz um select das linhas de curtidas que possui o id_tema do que está no array no momento AND 
as linhas de curtida que possui o id_usuario de quem esta logado no momento, se retornar algo significa que
o usuario ja curtiu)

## Abriu a tela de debates antigos:
☐ Abre a Tabela Debate e faz um SELECT das linhas que com o 

############################################################

## PHP - BackEnd - Charles e Shayane - 16/01
☐ iniciar edição de perfil e senha - UPDATE 
☐ adicionar (comentário) -  SELECT 
☐ adicionar (resposta) -  SELECT 
☐ iniciar tabela DEBATE - INSERT
☐ resolver problema da tabela curtida 

**ver video sobre chaves estrangeiras no pgAdmin**

OBS: -> não esquecer dos códigos com chaves estrangeiras. 

## Atividade
* Lorena
    **adicionar tabela "arquivo" ou incluir dados de arquivo no usuario**
    **adicionar bio na tabela de usuario**