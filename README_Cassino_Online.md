
# Cassino Online - Projeto de Portfólio
OBS: rode um npm install e um composer install antes de qualquer coisa.


Este projeto é um site de cassino online, criado para demonstrar meus conhecimentos em desenvolvimento web, especialmente para vagas de emprego. O sistema possui um único jogo disponível no momento, com funcionalidades de login, registro de usuários e um sistema de saldo. O projeto foi desenvolvido utilizando **Vite**, **Laravel** e **PHP**.

## Como Iniciar o Projeto

1. **Iniciar o servidor de desenvolvimento:**

   Para iniciar o front-end e back-end do projeto, execute o seguinte comando:

   ```bash
   npm run dev
   ```

   Este comando vai iniciar o Vite, responsável pelo desenvolvimento do front-end, junto com o Laravel, que cuida da parte do servidor.

2. **Iniciar o servidor Laravel:**

   Para iniciar o servidor do Laravel, execute:

   ```bash
   php artisan serve
   ```

3. **Executar as migrations:**

   Para criar as tabelas no banco de dados, execute:

   ```bash
   php artisan migrate
   ```

4. **Criar um usuário padrão:**

   O comando a seguir vai criar um usuário padrão no sistema:

   ```bash
   php artisan db:seed
   ```

   Ao rodar esse comando, o usuário criado já virá com um saldo de 100 BRL.

## Funcionamento do Site

Ao acessar o site, você será redirecionado para a página inicial. Um mini passo a passo será exibido para guiar a navegação.

### Opções de Acesso

1. **Login / Registro:**
   
   - Na página inicial, você pode fazer login ou criar uma nova conta.
   - Caso não tenha conta, o sistema oferece uma opção de registro. 

2. **Página de Jogo:**

   - Após fazer o login, você será redirecionado para a página do jogo (atualmente, temos apenas um jogo disponível).
   - No canto superior direito, no menu, aparecerá um link chamado "Games". 
   - Você pode acessar os jogos através desse menu ou pelo ícone do hambúrguer no canto superior esquerdo.

### Requisitos para Jogar

- **Autenticação:** Você precisa estar logado para jogar.
- **Saldo:** É necessário ter saldo para jogar. Caso o usuário não tenha saldo, poderá adicionar através da interface.
- Ao rodar o comando de seed, o usuário já começa com um saldo de 100 BRL.

Este projeto é uma simulação de um site de cassino, com foco em demonstrar minhas habilidades de desenvolvimento.
