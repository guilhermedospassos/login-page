# Login Page — PHP & MySQL

Aplicação de autenticação e gerenciamento de perfil em PHP, com cadastro, login, área autenticada e edição de dados. A versão atual moderniza as consultas, sessões e manipulação de senhas, preservando a finalidade original do projeto.

## Funcionalidades

- Cadastro com validação de nome, e-mail, idade e senha
- Login com verificação de senha por hash e atualização gradual de senhas legadas após autenticação
- Sessões com renovação de identificador ao entrar, cookies HttpOnly e SameSite
- Consultas SQL preparadas com MySQLi
- Proteção CSRF nos formulários e no logout
- Escapamento de dados apresentados nas páginas
- Edição de perfil limitada ao usuário autenticado
- Configuração de acesso ao banco por variáveis de ambiente

## Tecnologias

PHP 8+, MySQL, MySQLi, HTML, Bootstrap e sessões PHP.

## Preparação

1. Clone o repositório:

   ```bash
   git clone https://github.com/guilhermedospassos/login-page.git
   cd login-page
   ```

2. Crie um banco MySQL e aplique `database/schema.sql` para instalações novas. Para bases antigas, confira o tamanho da coluna `Password`, que precisa comportar hashes de até 255 caracteres. Faça backup antes de qualquer alteração de esquema.

3. Configure **no ambiente do processo PHP**, e não no código-fonte, as variáveis `DB_HOST`, `DB_PORT`, `DB_NAME`, `DB_USER` e `DB_PASSWORD`. Consulte `.env.example` apenas como referência de nomes; este projeto **não carrega arquivos .env automaticamente**.

4. Configure um servidor PHP com extensão `mysqli` e acesso ao MySQL. Para testes locais, na pasta do projeto:

   ```bash
   php -S 127.0.0.1:8000
   ```

5. Abra `http://127.0.0.1:8000` e teste o ciclo de cadastro, login, edição e logout.

## Arquivos principais

- `index.php` — autenticação
- `registro.php` — registro de usuários
- `home.php` — área de usuário
- `editar.php` — edição de perfil
- `php/bootstrap.php` — inicialização da sessão e funções comuns
- `php/config.php` — conexão ao MySQL por variáveis de ambiente
- `php/logout.php` — encerramento de sessão
- `database/schema.sql` — estrutura SQL para bancos novos

## Compatibilidade e validação

A autenticação reconhece hashes atuais e faz **migração progressiva de senhas antigas em texto puro apenas após um login válido**, para preservar o acesso a registros legados. Para encerrar completamente essa compatibilidade em uma implantação com usuários reais, é preciso migrar ou redefinir todas as senhas antigas e depois remover o caminho legado.

O código foi atualizado, mas **a integração com banco MySQL e os fluxos completos ainda precisam ser validados em ambiente de execução** antes de uma implantação pública. Em produção também é necessário configurar HTTPS, limites de tentativas de autenticação, política de cookies adequados ao proxy e observabilidade.

Projeto de portfólio sobre desenvolvimento web, autenticação e manutenção evolutiva de código.
