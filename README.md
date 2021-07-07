sail:
nano ~/.bash_aliases
alias sail='bash vendor/bin/sail'
dai: sail artisan serve

para fuincionar rotas custom:

namespace Illuminate\Routing;
linha 49
protected static $verbs = [
        'index' => 'index',
        'create' => 'create',
        'store' => 'store',
        'show' => 'show',
        'edit' => 'edit',
        'update' => 'update',
        'destroy' => 'destroy',
    ];


 order = /api/task?order=title,desc
 like = /api/task?like=title,a
 where = /api/users?where=id,>,1
 orWhere = /api/users?orWhere=name,=,Nandao
 with = /api/users?with=task,post
groupBy = /api/users?groupBy=id,name
select = /api/users?select=users.id,name,email
join = /api/users?join=posts,posts.user_id,users.id,tasks,tasks.user_id,users.id
leftJoin = /api/users?leftJoin=posts,posts.user_id,users.id,tasks,tasks.user_id,users.id
rightJoin = /api/users?rightJoin=tasks,tasks.user_id,users.id

construct() {
    $this->middleware('auth');
    $this->model = $modelo;
    $this->path = 'admin.modelo';
    $this->redirectPath = 'modelo';
    $this->withFields = ['marcas', 'tipo_veiculos'];
    $this->selectModelFields = ['Marca' => '\App\Models\Marca', 'TipoVeiculo' => '\App\Models\TipoVeiculo'];
    $this->joinSearch = ['marca_id' => ['nome', '\App\Models\Marca'], 'tipo_veiculo_id' => ['nome', '\App\Models\TipoVeiculo']];
}


<div class="form-group row mb-5 {{ $errors->has('foto') ? 'has-error' : ''}}">
    <div class="col-2">
    </div>
    <div class="col-10">
        <label for="foto" class="control-label">{{ '' }}</label>
        <img class="img-fluid" src="{{ isset($result->foto) ? asset($result->foto) : '' }}" alt="{{ isset($result->foto) ? $result->foto : '' }}" >
    </div>  
</div>



php artisan crud:generate Fornecedor --fields='razao_social#string; nome_fantasia#string; cnpj#string; telefone#string; cep#string; complemento#string; estado#string; cidade#string; bairro#string; endereco#string; numero#integer; status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes

php artisan crud:generate TipoCorrecao --fields='nome#string;descricao#text;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes


php artisan crud:generate Modelo --fields='tipo_veiculo_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};marca_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"}; modelo#string; descricao#text;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --foreign-keys="tipo_veiculo_id#id#tipo_veiculos#cascade" --relationships="tipo_veiculos#hasMany#App\Models\TipoVeiculo; marcas#hasMany#App\Models\Marca"


 
php artisan crud:generate Abastecimento --fields='modelo_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"}; tipo_combustivel_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"}; fornecedor_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"} quantidade_litros#integer; km_atual#double; responsavel#string; foto#string;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --foreign-keys="modelo_id#id#modelos#cascade" --relationships="modelo#hasOne#App\Models\Modelo; tipo_combustivel#hasOne#App\Models\TipoCombustivel; fornecedor#hasOne#App\Models\Fornecedor;"


cadastro com o ano do created at

motorista_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};veiculo_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};tipo_infracoes_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};)ocorrencia#string;numero_ait#string;estado_id#integer;municipio_id#integer;endereco_multa#string;data_multa#date;hora_multa#time;orgao_correspondente#string;enquadramento#string;data_vencimento#date;valor_multa#double;pago#boolean;foto_multa#file;

 

 sequencial_ano (nao precisa ter no banco) exibir campo concatenando o id de cadastro com o ano do created at


php artisan crud:generate Manutencao --fields='modelo_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};tipo_manutencao_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};fornecedor_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};problema_corrigido_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};responsavel_retirada#string;descricao_manutencao#text;numero_processo#string;data#date;hora#time;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --relationships="modelo#hasOne#App\Models\Modelo" --foreign-keys="modelo_id#id#modelos#cascade"







php artisan crud:generate LancamentoMultas --fields='motorista_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};veiculo_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};tipo_infracoes_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};ocorrencias#string;numero_ait#string;estado_id#integer;municipio_id#integer;endereco_multa#string;data_multa#date;hora_multa#time;orgao_correspondente#string;enquadramento#string;data_vencimento#date;valor_multa#double;pago#boolean;foto_multa#file;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --relationships="motorista#hasOne#App\Models\Motoristum" --foreign-keys="motorista_id#id#motoristas#cascade"





php artisan crud:generate Frota --fields=';status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --relationships="tipo_veiculo#hasOne#App\Models\TipoVeiculo" --foreign-keys="tipo_combustivel_id#id#tipo_veiculos#cascade"


amarrar com o modelo para pegar a placa do veículo


 



php artisan crud:generate VeiculoEntrada --fields='controle_frota_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};km_final#double;relatorio_trajeto_motorista#text;quantidade_combustivel#double;observacao#text;nome_responsavel#string;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --relationships="controle_frota_id#hasOne#App\Models\ControleFrotum" --foreign-keys="controle_frota_id#id#controle_frotas#cascade"




calendario: 

php artisan crud:generate VeiculoAgendamento --fields='controle_frota_id#select#options={"1": "Technology", "2": "Tips", "3": "Health"};departamento#select#options={"manha": "Manhã", "tarde": "Tarde", "integral": "Integral"};periodo#select#options={"manha": "Manhã", "tarde": "Tarde", "integral": "Integral"};telefone#string,local#string;previsao_saida#datetime;previsao_volta#datetime;status#boolean' --view-path=admin --controller-namespace=App\\Http\\Controllers\\Admin --form-helper=html --soft-deletes=yes --relationships="controle_frota_id#hasOne#App\Models\ControleFrotum" --foreign-keys="controle_frota_id#id#controle_frotas#cascade"


FALTA OS JOINS e FOREIGH KEY

 category#select#options={"technology": "Technology", "tips": "Tips", "health": "Health"}
 --relationships="comments#hasMany#App\Comment"
 --foreign-keys="user_id#id#users#cascade"


 php artisan migrate --path=/database/migrations/
