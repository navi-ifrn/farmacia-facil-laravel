```sh
$ touch database/database.sqlite

$ ./artisan make:auth

$ ./artisan make:model -m Laboratorio
$ ./artisan make:controller LaboratorioController --resource
$ ./artisan migrate

$ ./artisan make:model -m Medicamento
$ ./artisan make:controller MedicamentoController --resource
$ ./artisan migrate

$ ./artisan make:model -m Estoque
$ ./artisan make:controller EstoqueController --resource
$ ./artisan migrate


```