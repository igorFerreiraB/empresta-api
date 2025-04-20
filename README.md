## API de Simulação de Empréstimos - Desafio Backend Empresta

API REST para simulação de empréstimos consignados com integração para aplicações web e mobile, desenvolvida como solução para o desafio técnico da Emprestra.

## Funcionalidades principais

- **Consulta de instituições financeiras**

- **Consulta de convênios disponíveis**

- **Simulação de empréstimos com cálculo de parcelas**

## Tecnologias Utilizadas

- **PHP 8+**

- **Laravel 12**

## Instalação

```bash
git clone https://github.com/igorFerreiraB/empresta-api.git
cd empresta-api
composer install
cp .env.example .env
php artisan key:generate
php artisan serve
```

## Cálculo do Coeficiente

O coeficiente é utilizado para calcular o valor da parcela de um empréstimo e é baseado na fórmula da Tabela Price:

```coeficiente = [i × (1 + i)^n] / [(1 + i)^n - 1]```

Onde:
- `i` = taxa de juros mensal (ex: 2% = 0.02)
- `n` = número de parcelas

O valor da parcela é obtido multiplicando o valor solicitado pelo coeficiente:
```valor_parcela = valor_emprestimo × coeficiente```


## Requisitos

- **Git**

- **PHP 8.2**

- **Composer 2.0+**

- **Pest 3.8**


## Rodando os Testes

Para executar os testes unitários da aplicação:

```bash
# Usando o Pest
./vendor/bin/pest
```

## Endpoints da API

- **GET /api/instituicoes**
Retorna a lista de instituições financeiras disponíveis.

- **GET /api/convenios**
Retorna a lista de convênios disponíveis.

- **POST /api/simulacao**
Realiza a simulação de empréstimo com base nos parâmetros fornecidos.
