# Login Page — estudo de autenticação com PHP

Projeto de estudo de **login, cadastro e gerenciamento de informações do usuário**, construído com PHP e interfaces HTML/CSS, utilizando Bootstrap e MySQL.

## O que há no repositório

- `index.php` — formulário de login
- `registro.php` — cadastro de usuário
- `home.php` — página acessada após autenticação
- `editar.php` — edição de informações
- `php/config.php` — conexão com o banco de dados
- `php/logout.php` — encerramento da sessão
- `style/` — arquivos de estilo

## Tecnologias

PHP, MySQL, HTML, CSS, Bootstrap e sessões PHP.

## Execução local

Este projeto **requer um ambiente com PHP e MySQL**; não é uma página estática que funciona apenas abrindo `index.php` no navegador.

1. Clone o repositório:
   ```bash
   git clone https://github.com/guilhermedospassos/login-page.git
   ```
2. Configure um servidor PHP local e um banco MySQL de teste.
3. Inspecione `php/config.php` e configure a conexão para o seu ambiente **sem publicar credenciais reais**.
4. Verifique as tabelas e colunas exigidas pelas consultas no código. O repositório não disponibiliza uma migração de banco de dados automatizada.
5. Execute o projeto pelo servidor PHP, com o banco configurado.

## Aviso de segurança

**Este é um exercício acadêmico/educacional, não uma solução de autenticação pronta para produção.** A implementação original compara senhas diretamente nas consultas ao banco e não demonstra proteção adequada por hash de senha e consultas parametrizadas em todos os fluxos. Antes de qualquer uso real, é necessário revisar a aplicação, incluindo `password_hash()`, `password_verify()`, prepared statements, validação de entradas, sessões e tratamento de erros.

Nunca reutilize credenciais reais nem exponha este projeto com dados de usuários.

## Status

Projeto de aprendizagem mantido para documentar minha evolução em desenvolvimento web e PHP.
