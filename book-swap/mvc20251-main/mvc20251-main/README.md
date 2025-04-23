# Plataforma de Troca de Livros

Uma plataforma web onde os usuários podem listar livros para troca e marcar trocas com outros usuários.

## Requisitos

- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)

## Instalação

1. Clone o repositório:
```bash
git clone [url-do-repositorio]
```

2. Crie o banco de dados:
```bash
mysql -u root -p < database/schema.sql
```

3. Configure as credenciais do banco de dados no arquivo `config/database.php`

4. Configure seu servidor web para apontar para o diretório do projeto

## Estrutura do Projeto

- `model/`: Classes de modelo (Usuario, Livro, Troca)
- `dao/`: Classes de acesso a dados
- `controller/`: Controladores da aplicação
- `config/`: Arquivos de configuração
- `database/`: Scripts SQL
- `public/`: Arquivos públicos (CSS, JS, imagens)
- `template/`: Templates das páginas

## Funcionalidades

- Cadastro e autenticação de usuários
- Listagem de livros disponíveis para troca
- Cadastro de novos livros
- Proposta de troca entre usuários
- Gerenciamento de trocas (aceitar/recusar/concluir)

## Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/nova-feature`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova feature'`)
4. Push para a branch (`git push origin feature/nova-feature`)
5. Abra um Pull Request
