# Especificacao de Requisitos de Software

## Sistema Administrativo Bodyfit Academia

**Padrao de referencia:** ISO/IEC/IEEE 29148:2018  
**Versao do documento:** 1.0  
**Projeto:** Bodyfit Academia - Sistema Administrativo  
**Tecnologias principais:** PHP, PostgreSQL, HTML, CSS e JavaScript

---

## Historico de Revisoes

| Versao | Data | Descricao | Autor |
| --- | --- | --- | --- |
| 1.0 | 2026-06-11 | Criacao da especificacao de requisitos no modelo ISO/IEC/IEEE 29148:2018. | Equipe do projeto |

---

## 1. Introducao

### 1.1 Proposito

Este documento especifica os requisitos do Sistema Administrativo Bodyfit Academia. O objetivo e descrever, de forma clara e verificavel, as funcionalidades, restricoes, interfaces e criterios de aceitacao do sistema.

### 1.2 Escopo

O sistema deve permitir que funcionarios administrativos de uma academia realizem o gerenciamento de alunos, planos, bloqueios de acesso e indicadores administrativos por meio de uma aplicacao web.

O sistema contempla:

- Autenticacao administrativa.
- Dashboard com dados reais do banco de dados.
- Cadastro, edicao, listagem e exclusao de usuarios/alunos.
- Upload e exibicao de foto do usuario.
- Controle de planos.
- Controle de bloqueios e desbloqueios de usuarios.

O sistema nao contempla, nesta versao:

- Pagamentos online.
- Integracao com catracas ou leitores biometricos.
- Aplicativo mobile.
- Recuperacao automatica de senha.

### 1.3 Definicoes, Siglas e Abreviacoes

| Termo | Definicao |
| --- | --- |
| Aluno | Usuario cadastrado como cliente da academia. |
| Funcionario | Usuario administrativo autorizado a acessar o sistema. |
| Dashboard | Painel com indicadores e informacoes resumidas do sistema. |
| Bloqueio | Registro que impede ou sinaliza a restricao de um aluno no sistema. |
| SRS | Software Requirements Specification, ou Especificacao de Requisitos de Software. |
| PDO | PHP Data Objects, camada de acesso a banco de dados utilizada no PHP. |

### 1.4 Referencias

- ISO/IEC/IEEE 29148:2018 - Systems and software engineering: Life cycle processes: Requirements engineering.
- Prototipo visual no Figma: [Acessar prototipo](https://www.figma.com/design/aOY5mA3bLgW56Nf9tEvdM0/Sem-t%C3%ADtulo?node-id=6-159&t=bx76o4NCV3A6Xaqk-1)

### 1.5 Visao Geral do Documento

Este documento esta organizado em contexto do sistema, requisitos de stakeholders, requisitos funcionais, requisitos nao funcionais, interfaces, dados, criterios de aceitacao, matriz de rastreabilidade e instrucoes tecnicas do projeto.

---

## 2. Descricao Geral do Sistema

### 2.1 Perspectiva do Produto

O Bodyfit Academia e uma aplicacao web administrativa executada em ambiente local ou servidor PHP. O sistema utiliza PostgreSQL para persistencia de dados e organiza as funcionalidades em modulos PHP separados por responsabilidade.

### 2.2 Classes de Usuarios

| Classe | Descricao | Permissoes Esperadas |
| --- | --- | --- |
| Funcionario administrativo | Pessoa responsavel pela operacao do sistema. | Login, acesso ao dashboard, gerenciamento de alunos, planos e bloqueios. |
| Aluno | Pessoa cadastrada como cliente da academia. | Nao acessa diretamente o painel administrativo nesta versao. |

### 2.3 Ambiente Operacional

| Item | Descricao |
| --- | --- |
| Sistema operacional | Ambiente compativel com servidor PHP e PostgreSQL. |
| Servidor | Servidor local ou web com suporte a PHP. |
| Banco de dados | PostgreSQL. |
| Navegador | Navegadores modernos com suporte a HTML5, CSS3 e JavaScript. |

### 2.4 Restricoes Gerais

- O sistema deve utilizar PostgreSQL como banco de dados.
- O acesso ao painel administrativo deve exigir sessao autenticada.
- Os arquivos enviados como foto de usuario devem ser armazenados no servidor.
- As consultas que recebem dados sensiveis do usuario devem utilizar consultas preparadas com PDO.
- A interface deve seguir a identidade visual proposta no prototipo do Figma.

### 2.5 Premissas e Dependencias

- O banco `academia_bd` deve existir no PostgreSQL.
- As credenciais de acesso ao banco devem estar configuradas em `config/conexao.php`.
- O servidor PHP deve ter permissao de escrita em `assets/img/usuarios/`.
- O navegador deve permitir execucao de JavaScript para mascaras, preview de foto e grafico do dashboard.

---

## 3. Requisitos de Stakeholders

| ID | Stakeholder | Necessidade | Prioridade |
| --- | --- | --- | --- |
| STK-001 | Funcionario administrativo | Acessar o sistema com login seguro. | Alta |
| STK-002 | Funcionario administrativo | Consultar indicadores reais da academia no dashboard. | Alta |
| STK-003 | Funcionario administrativo | Cadastrar alunos com dados completos e foto. | Alta |
| STK-004 | Funcionario administrativo | Gerenciar alunos ja cadastrados. | Alta |
| STK-005 | Funcionario administrativo | Bloquear e desbloquear alunos quando necessario. | Alta |
| STK-006 | Gestao da academia | Manter dados persistidos em banco de dados. | Alta |

---

## 4. Requisitos Funcionais

### RF-001 - Autenticacao Administrativa

**Descricao:** O sistema deve permitir que funcionarios administrativos realizem login por meio de CPF e senha.  
**Prioridade:** Alta  
**Origem:** STK-001  
**Criterio de aceitacao:** Dado um funcionario existente no banco, quando CPF e senha corretos forem enviados, entao o sistema deve criar a sessao e redirecionar para o dashboard.

### RF-002 - Encerramento de Sessao

**Descricao:** O sistema deve permitir que o funcionario encerre a sessao administrativa.  
**Prioridade:** Alta  
**Origem:** STK-001  
**Criterio de aceitacao:** Quando o funcionario acessar a acao de logout, entao a sessao deve ser encerrada e o usuario deve voltar para a tela de login.

### RF-003 - Protecao de Paginas Administrativas

**Descricao:** O sistema deve impedir acesso direto a paginas administrativas sem sessao ativa.  
**Prioridade:** Alta  
**Origem:** STK-001  
**Criterio de aceitacao:** Dado um usuario nao autenticado, quando tentar acessar dashboard, usuarios, planos ou bloqueios, entao deve ser redirecionado para o login.

### RF-004 - Dashboard Administrativo

**Descricao:** O sistema deve exibir indicadores reais do banco de dados no dashboard.  
**Prioridade:** Alta  
**Origem:** STK-002  
**Criterio de aceitacao:** Quando nao houver usuarios cadastrados, o total de usuarios ativos deve ser exibido como zero, sem valores ficticios.

### RF-005 - Listagem de Atividades Recentes

**Descricao:** O sistema deve listar atividades recentes com base em registros reais do banco, como cadastros e bloqueios.  
**Prioridade:** Media  
**Origem:** STK-002  
**Criterio de aceitacao:** Quando existirem registros recentes, eles devem aparecer na tabela; quando nao existirem, deve ser exibida uma mensagem informativa.

### RF-006 - Cadastro de Usuarios

**Descricao:** O sistema deve permitir o cadastro de alunos com nome, CPF, email, telefone, CEP, numero, cidade, estado, plano e status.  
**Prioridade:** Alta  
**Origem:** STK-003  
**Criterio de aceitacao:** Quando os campos obrigatorios forem preenchidos corretamente, o aluno deve ser salvo no banco e aparecer no gerenciamento de usuarios.

### RF-007 - Upload de Foto do Usuario

**Descricao:** O sistema deve permitir o envio de foto no cadastro e na edicao do usuario.  
**Prioridade:** Media  
**Origem:** STK-003  
**Criterio de aceitacao:** Quando uma imagem valida for enviada, o arquivo deve ser armazenado em `assets/img/usuarios/` e o caminho deve ser associado ao usuario.

### RF-008 - Exibicao de Foto no Gerenciamento

**Descricao:** O sistema deve exibir a foto do aluno na tabela de gerenciamento de usuarios de forma discreta.  
**Prioridade:** Media  
**Origem:** STK-004  
**Criterio de aceitacao:** Dado um aluno com foto cadastrada, quando a tela de gerenciamento for aberta, entao sua foto deve aparecer ao lado dos dados do aluno.

### RF-009 - Edicao de Usuarios

**Descricao:** O sistema deve permitir editar dados de usuarios cadastrados.  
**Prioridade:** Alta  
**Origem:** STK-004  
**Criterio de aceitacao:** Quando os dados forem alterados e salvos, as informacoes atualizadas devem persistir no banco.

### RF-010 - Exclusao de Usuarios

**Descricao:** O sistema deve permitir excluir usuarios cadastrados.  
**Prioridade:** Media  
**Origem:** STK-004  
**Criterio de aceitacao:** Quando a exclusao for confirmada, o usuario deve ser removido do banco e deixar de aparecer na listagem.

### RF-011 - Bloqueio de Usuarios

**Descricao:** O sistema deve permitir bloquear um usuario ativo, registrando motivo e status do bloqueio.  
**Prioridade:** Alta  
**Origem:** STK-005  
**Criterio de aceitacao:** Quando um usuario for bloqueado, seu status deve ser atualizado para inativo e um registro ativo deve ser criado na tabela de bloqueios.

### RF-012 - Desbloqueio de Usuarios

**Descricao:** O sistema deve permitir revogar bloqueios ativos de usuarios.  
**Prioridade:** Alta  
**Origem:** STK-005  
**Criterio de aceitacao:** Quando um bloqueio for revogado, o status do aluno deve voltar para ativo e o registro de bloqueio deve ser marcado como revogado.

### RF-013 - Controle de Planos

**Descricao:** O sistema deve disponibilizar uma area para controle dos planos da academia.  
**Prioridade:** Media  
**Origem:** STK-006  
**Criterio de aceitacao:** O funcionario deve conseguir acessar a area de planos pelo menu lateral.

---

## 5. Requisitos Nao Funcionais

| ID | Categoria | Requisito | Prioridade | Criterio de Verificacao |
| --- | --- | --- | --- | --- |
| RNF-001 | Seguranca | O sistema deve usar consultas preparadas com PDO em operacoes que recebem dados de formulario. | Alta | Revisao de codigo confirma uso de `prepare` e `execute`. |
| RNF-002 | Seguranca | Paginas administrativas devem validar a existencia da sessao do funcionario. | Alta | Acesso sem sessao redireciona para login. |
| RNF-003 | Usabilidade | A interface deve ser simples, visualmente organizada e adequada ao uso administrativo. | Media | Fluxos principais acessiveis pelo menu e botoes visiveis. |
| RNF-004 | Persistencia | Dados principais devem ser armazenados no PostgreSQL. | Alta | Cadastros, edicoes e bloqueios persistem no banco. |
| RNF-005 | Compatibilidade | O sistema deve funcionar em navegadores modernos. | Media | Telas carregam corretamente com HTML5, CSS3 e JavaScript habilitado. |
| RNF-006 | Manutenibilidade | O projeto deve manter separacao por modulos funcionais. | Media | Arquivos organizados em `login`, `dashboard`, `usuarios`, `planos`, `bloqueios` e `includes`. |
| RNF-007 | Integridade | O dashboard nao deve exibir dados ficticios como se fossem dados reais. | Alta | Valores exibidos devem ser derivados do banco ou zero em caso de ausencia de dados. |

---

## 6. Requisitos de Interface Externa

### 6.1 Interface de Usuario

O sistema deve possuir as seguintes telas principais:

| Tela | Finalidade | Arquivo Principal |
| --- | --- | --- |
| Login | Autenticacao administrativa. | `pages/login/login.php` |
| Dashboard | Consulta de indicadores e atividades recentes. | `pages/dashboard/dashboard.php` |
| Cadastro de usuarios | Registro de novos alunos. | `pages/usuarios/cadastro_usuarios.php` |
| Gerenciamento de usuarios | Listagem e acoes sobre alunos. | `pages/usuarios/gerenciamento_usuarios.php` |
| Controle de bloqueios | Registro e revogacao de bloqueios. | `pages/bloqueios/controle_bloqueios.php` |
| Controle de planos | Gerenciamento dos planos. | `pages/planos/controle_planos.php` |

### 6.2 Interface de Software

| Componente | Descricao |
| --- | --- |
| PHP | Linguagem principal da aplicacao. |
| PDO | Interface de comunicacao entre PHP e PostgreSQL. |
| PostgreSQL | Banco de dados relacional do sistema. |
| JavaScript | Mascaras de campos, preview de foto, busca em tabelas e grafico do dashboard. |
| CSS | Estilizacao da interface administrativa. |

### 6.3 Interface de Dados

Tabelas utilizadas ou previstas:

| Tabela | Finalidade |
| --- | --- |
| `funcionarios` | Armazenar usuarios administrativos. |
| `usuarios` | Armazenar alunos cadastrados. |
| `planos` | Armazenar planos da academia. |
| `bloqueados` | Armazenar historico de bloqueios. |
| `pagamentos` | Estrutura prevista para controle de pagamentos. |
| `acessos` | Estrutura prevista para historico de acessos. |

---

## 7. Regras de Negocio

| ID | Regra |
| --- | --- |
| RN-001 | Apenas funcionarios autenticados podem acessar as paginas administrativas. |
| RN-002 | Um usuario bloqueado deve ficar com status `inativo`. |
| RN-003 | Ao desbloquear um usuario, seu status deve voltar para `ativo`. |
| RN-004 | Uma foto de usuario deve ser associada ao cadastro apenas quando o upload for valido. |
| RN-005 | Indicadores administrativos devem refletir os dados persistidos no banco. |

---

## 8. Criterios Gerais de Aceitacao

- O funcionario consegue fazer login com credenciais validas.
- O funcionario nao autenticado nao consegue acessar areas administrativas.
- O dashboard nao apresenta numeros ficticios.
- O cadastro de usuario salva os dados no banco.
- A foto enviada no cadastro aparece no gerenciamento de usuarios.
- O funcionario consegue bloquear e desbloquear usuarios.
- Os bloqueios aparecem no controle de bloqueios.
- As paginas principais carregam sem erros de sintaxe PHP.

---

## 9. Matriz de Rastreabilidade

| Stakeholder | Requisito Funcional | Requisito Nao Funcional Relacionado |
| --- | --- | --- |
| STK-001 | RF-001, RF-002, RF-003 | RNF-001, RNF-002 |
| STK-002 | RF-004, RF-005 | RNF-007 |
| STK-003 | RF-006, RF-007 | RNF-004, RNF-005 |
| STK-004 | RF-008, RF-009, RF-010 | RNF-003, RNF-006 |
| STK-005 | RF-011, RF-012 | RNF-004, RNF-007 |
| STK-006 | RF-013 | RNF-004, RNF-006 |

---

## 10. Estrutura do Projeto

```text
Projeto/
+-- assets/
|   +-- css/
|   |   +-- style.css
|   +-- img/
|   |   +-- logo.png
|   |   +-- gym-bg.png
|   |   +-- usuarios/
|   +-- js/
|       +-- main.js
+-- config/
|   +-- conexao.php
+-- pages/
|   +-- bloqueios/
|   +-- dashboard/
|   +-- includes/
|   +-- login/
|   +-- planos/
|   +-- usuarios/
+-- backup.sql
+-- comandos.sql
+-- index.php
+-- readme.md
```

---

## 11. Configuracao e Execucao

### 11.1 Banco de Dados

O sistema utiliza PostgreSQL. A configuracao de conexao esta em:

```text
config/conexao.php
```

Configuracao padrao:

```php
$host = "localhost";
$dbaname = "academia_bd";
$user = "postgres";
$password = "postgres";
```

### 11.2 Passos para Execucao

1. Instalar um servidor local com suporte a PHP.
2. Criar o banco de dados `academia_bd` no PostgreSQL.
3. Importar os scripts SQL disponiveis em `backup.sql` e/ou `comandos.sql`.
4. Conferir as credenciais em `config/conexao.php`.
5. Acessar o projeto pelo navegador.

Exemplo:

```text
http://localhost/Projeto/
```

---

## 12. Verificacao Recomendada

| Item | Verificacao |
| --- | --- |
| Sintaxe PHP | Executar `php -l` nos arquivos PHP alterados. |
| Login | Testar credenciais validas e invalidas. |
| Dashboard | Conferir se os totais batem com o banco. |
| Cadastro | Cadastrar usuario com e sem foto. |
| Foto | Verificar se a imagem aparece em `assets/img/usuarios/` e na listagem. |
| Bloqueio | Bloquear e desbloquear usuario, conferindo status no banco. |

---

## 13. Autor

Projeto desenvolvido para fins academicos e pratica de desenvolvimento web com PHP e PostgreSQL.
