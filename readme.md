[Templates Bases](https://gist.github.com/jeanjar/aa5783dcc4e50122f596d5a79c56a96a)
## Instalando o projeto
```sh
$ composer install
$ cp .env.example .env
$ touch database/database.sqlite
$ ./artisan make:auth
$ ./artisan key:generate
$ ./artisan migrate
$ ./artisan serve
```
## Laboratórios
[Templates CRUD Laboratório](https://gist.github.com/jeanjar/5fe87f187949de2de781114fc82e75a2)
```sh
$ ./artisan make:model -m Laboratorio
$ ./artisan make:controller LaboratorioController --resource
$ ./artisan migrate
```

## Medicamentos
[Templates CRUD Medicamentos](https://gist.github.com/jeanjar/ab6c01ac0b430850ccdd6688d9db679f)

```sh
$ ./artisan make:model -m Medicamento
$ ./artisan make:controller MedicamentoController --resource
$ ./artisan migrate
```
## Vendas
[Templates CRUD Venda](https://gist.github.com/jeanjar/7ec991c1f4559953b6d0d02ce0a354dc)
```sh
$ ./artisan make:model -m Venda
$ ./artisan make:controller VendaController
$ ./artisan make:migration create_table_medicamento_venda --create=medicamento_venda
```
