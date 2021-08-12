<?php

namespace App\Http\Controllers\Configuracoes;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Perfil;
use App\Models\Permisso;
use App\Models\PermissoesUsuario;
use Illuminate\Http\Request;
use App\Traits\CrudControllerTrait;

class PerfilController extends Controller
{
    use CrudControllerTrait;

    private $model;
    private $path;
    private $redirectPath;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Perfil $perfil)
    {
        $this->middleware('auth');
        $this->model = $perfil;
        $this->saveSetorScope = true;
        $this->path = 'configuracoes.perfil';
        $this->redirectPath = 'perfil';
        $this->pdfFields = [['nome'],['descricao'], ['status']];
        $this->pdfTitles = ['Nome','Descrição', 'Status'];
        $this->indexFields = [['nome'],['descricao'], ['status']];
        $this->indexTitles = ['Nome','Descrição', 'Status'];
        $this->selectModelFields = ['Setor' => '\App\Models\Setor'];
        $this->joinSearch = ['setor_id' => ['nome', '\App\Models\Setor']];

                $this->pdfTitle = 'Perfil';

    }

    /**
     * rota customizada da show
     *
     * @return \Illuminate\Http\Response
     */
    public function customEdit($id)
    {
        $permissoesList = Permisso::select(
                'id',
                'titulo',
                'descricao',
                'quem_pertence'
            )
            ->where('status','=', true)
//            ->whereNotIn('quem_pertence', ['REGISTRODEPONTO', 'COLABORADORHISTORICOS'])
            ->orderBy( 'quem_pertence', 'ASC')
            ->get();

        $permissoesOrdenado = [];
        foreach($permissoesList as $key => $value){
            foreach($value->filhasQuemPertence as $key => $value){
//                if ($value->chave_ordem != 'CLIENTES' AND $value->chave_ordem != 'MARCACOESPONTOSAUDITORIA')
                    $permissoesOrdenado[$value->quem_pertence][$value['titulo']][$key] = $value;
            }
        }
//dd($permissoesOrdenado);

        return view($this->path.'.custom-edit', [
            'results' => $permissoesOrdenado,
            'idPermissao' => $id,
            'perfil' => Perfil::find($id)
        ]);
    }

    public function customUpdate(Request $request, $id)
    {
        $perfil = json_decode($request->perfil);

        PermissoesUsuario::where('setor_id', $perfil->setor_id)->where('perfil_id', $perfil->id)->delete();

        if(empty($request->chaves_ordem))
            return redirect()->back()->with('success', 'Salvo com sucesso!');

        foreach ($request->chaves_ordem as $key => $idpermissao) {
            PermissoesUsuario::create([
                'idpermissao' => $idpermissao,
                'tipo_usuario' => 'talvez pode apagar',
                'perfil_id' => $perfil->id,
                'setor_id' => $perfil->setor_id
            ]);
        }

        return redirect()->back()->with('success', 'Salvo com sucesso!');
    }
}
