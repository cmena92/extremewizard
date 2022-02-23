<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SisConfiguraciones;

/**
 * SisConfiguracionesSearch represents the model behind the search form about `app\models\SisConfiguraciones`.
 */
class SisConfiguracionesSearch extends SisConfiguraciones
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NombreComercial', 'Cedula', 'Canton', 'Distrito', 'Barrio', 'OtrasSenas', 'UsuarioDGT', 'ClaveDGT', 'ArchivoP12', 'Telefono', 'Correo', 'Fax', 'GrupoDeActivos', 'NombreDeLotes', 'Logo'], 'safe'],
            [['Persona', 'Provincia', 'MostrarSloganEnFactura', 'ClientePorDefecto', 'Ambiente', 'Inventario'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SisConfiguraciones::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'Persona' => $this->Persona,
            'Provincia' => $this->Provincia,
            'MostrarSloganEnFactura' => $this->MostrarSloganEnFactura,
            'ClientePorDefecto' => $this->ClientePorDefecto,
            'Ambiente' => $this->Ambiente,
            'Inventario' => $this->Inventario,
        ]);

        $query->andFilterWhere(['like', 'NombreComercial', $this->NombreComercial])
            ->andFilterWhere(['like', 'Cedula', $this->Cedula])
            ->andFilterWhere(['like', 'Canton', $this->Canton])
            ->andFilterWhere(['like', 'Distrito', $this->Distrito])
            ->andFilterWhere(['like', 'Barrio', $this->Barrio])
            ->andFilterWhere(['like', 'OtrasSenas', $this->OtrasSenas])
            ->andFilterWhere(['like', 'UsuarioDGT', $this->UsuarioDGT])
            ->andFilterWhere(['like', 'ClaveDGT', $this->ClaveDGT])
            ->andFilterWhere(['like', 'ArchivoP12', $this->ArchivoP12])
            ->andFilterWhere(['like', 'Telefono', $this->Telefono])
            ->andFilterWhere(['like', 'Correo', $this->Correo])
            ->andFilterWhere(['like', 'Fax', $this->Fax])
            ->andFilterWhere(['like', 'GrupoDeActivos', $this->GrupoDeActivos])
            ->andFilterWhere(['like', 'NombreDeLotes', $this->NombreDeLotes])
            ->andFilterWhere(['like', 'Logo', $this->Logo]);

        return $dataProvider;
    }
}
