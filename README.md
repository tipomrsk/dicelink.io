# [Rastreio.com]()

Serviço de rastreio de encomendas. Foi desenvolvimento de uma maneira simples onde o 'cliente' pode consultar as suas entregas e respectivos status.

Essa aplicação foi criada com o front desacoplado do back onde toda a comunicação é feita por uma API. 

> "*Pensei em utilizar Livewire para fazer, ficaria realmente fácil, mas muitas coisas que queria implementar não seriam possíveis. Então fiz desacoplado*"

Importante ter em mente também é que com a estrutura atual, qualquer implementação de serviço de monitoramento fica fácil de ser implementado.

#### [Opções de Monitoramento]()

- **APM**: New Relic ou Datadog.
- **Client**: LogRocket
- **Server**: UptimeRobot, NetData

> "*Propositalmente não mencionei **ElasticSearch** para APM, ou **Grafana com Prometheus** porque essas stacks por mais impressionantes que sejam quando prontas, manter envolve um custo muito alto de infra, equipe, disponibilidade...*
>
> *Acho que o mais apropriado aqui seria o NewRelic, o freemium é bem completo, além disso, a integração com o Laravel é bem simples e muito completa abrangendo até os logs internos, importante ter em mente que para projetos maiores ter um Repositório de Logs é imprescindível*"


---


## [Dockerização]()
### [Containers]()
- **app**: PHP-FPM
- **nginx**: NginX
- **mysql**: MySQL


### [app]()

É onde está o fonte da aplicação e todas as configurações dos serviços.

- php.ini (Configurações do PHP)
- php-fpm.conf (Configurações do PHP-FPM)
- www.conf (Configurações da web do PHP)
- opcache.ini (Configurações do OpCache)

### [web]()
Configurações do NginX, workers e proxy.

- nginx.conf (Configurações do NginX)
- app.conf (Configurações do NginX para o container do app)

### [db]()

MySQL com as configurações padrões.

---

## [Documentação da API]()

- [Postman Collection](https://www.postman.com/cloudy-crescent-618085/workspace/tipomrsk-public/collection/10062714-114a0d40-ce0f-4dda-a320-0de010c095e7?action=share&creator=10062714)

É importante executar os dois primeiros endpoints para popular o banco de dados na devida ordem.

#### Consulta e Persiste as Transportadoras do Mocky [Executar Primeiro]

```http
  GET /api/config/consult-persist-company
```

#### Consulta e Persiste as Entregas do Mocky [Executar Segundo]

```http
  GET /api/config/consult-persist-orders
```


#### Busca as Entregas de um Destinatário
```http
  GET /api/receiver/orders?cpf={cpf}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `cpf`      | `string` | **Obrigatório**. Somente numéricos |

#### Busca os status de uma entrega
```http
  GET /api/order/tracking?uuid={uuid}
```

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `uuid`      | `string` | **Obrigatório**. Identificador da entrega |


### [Por que um query string no cpf e UUID?]()
Decidi ir por esse caminho pelo Form Request que o Laravel fornece.
Poderia ir pelo caminho de montar um DTO com [Laravel Data](https://spatie.be/docs/laravel-data/v3/introduction), mas não achei necessário nesse momento.

---

## [Deploy]()

Para fazer deploy do projeto, você pode rodar executar o docker-compose desse projeto, ou executar o stack-deploy.sh

```bash
  sudo bash stack-deploy.sh [OPTION]
```

Option:
- --production


> Importante lembrar que o `stack-deploy.sh` é um arquivo que faz uma série de procedimentos, como instalar/atualizar as dependências do sistema, instalar o docker e docker-compose, **REMOVER CONTAINERS, IMAGENS, VOLUMES E ETC**. Ele foi criado para automatizar o deploy em um server novo.

> Se quiser testar o script, você executar em ambiente de WSL que é rápido para criar e testar, e qualquer problema você pode resetar o ambiente.
> Siga o `aws-launch-template.sh` para criar um ambiente de testes. 

> O `.env` está configurado para rodar com Docker, caso queira rodar em outro serviço lembre de alterar as configurações. 

#### Migrations
Migrations são executadas junto do container do app. Caso você opte por rodar o serviço separado em um LaraGon, Wallet, XAMPP, Artisan Serve... **NÃO ESQUEÇA DE EXECUTAR AS MIGRATIONS**

---

## [Stack, Serviços e Patterns]()

**Front-end:** Blade, Components, Bootstrap, JavaScript, jQuery, Axios

**Back-end:** PHP, Laravel

**Infra**: Docker, PHP-FPM, OpCache, NginX

**DB**: MySQL (Migrations e Factories)

**Patterns**: Service Repository, Form Request, Interface,

---


## [Rodando os testes]()

Para rodar os testes, rode o seguinte comando.
Testes Unitários e de Feature criados com [Pest](https://pestphp.com/). Rode as **Factories** antes dos testes.

```bash
  ./vendor/bin/pest
```


## [Demonstração]()

![gif](/app/public/img/rastreio.gif)

Para facilitar, seguem alguns CPFs e o que é esperado de retorno para cada um:

1. **54795289042** = Retornará entregas
2. **12345678901** = Não retornará entregas com erro.
3. **63079983009** = Não retornará entregas com aviso.

