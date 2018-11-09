package gesbiblio;

import javax.swing.table.DefaultTableModel;

public class Autor extends Sqlite implements OperacionesBD {
    String codigoautor, nombre, notas;
    
    public Autor(String ingCodigo, String ingNombre, String ingNotas) {
        this.codigoautor = ingCodigo;
        this.nombre = ingNombre;
        this.notas = ingNotas;
    }
    
    public Autor(String ingNombre, String ingNotas) {
        this.nombre = ingNombre;
        this.notas = ingNotas;
    }
    
    public Autor(){
        //Para instanciar sin atributos
    }
    
    public void setCodigoAutor(String ingCodigo){
        this.codigoautor = ingCodigo;
    }

    @Override
    public int agregar(){
        String strComAgregar;
        strComAgregar = String.format("INSERT INTO CAT_AUT_AUTOR VALUES (NULL, '%1$s', '%2$s');", this.nombre, this.notas);
        
        int verificaOp;
        verificaOp = super.operaInsertDeleteUpdate(strComAgregar);
        
        return verificaOp;
    }
    
    @Override
    public int eliminar(){
        String strComEliminar;
        strComEliminar = String.format("DELETE FROM CAT_AUT_AUTOR WHERE AUT_CODIGO = %1$s;", this.codigoautor);
        
        int verificaOp;
        verificaOp = super.operaInsertDeleteUpdate(strComEliminar);
        
        return verificaOp;
    }
    
    @Override
    public int editar(){
        String strComEditar;
        strComEditar = String.format("UPDATE CAT_AUT_AUTOR SET AUT_NOMBRE = '%1$s', AUT_DESCRIPCION = '%2$s' WHERE AUT_CODIGO = %3$s;", this.nombre, this.notas, this.codigoautor);
        
        int verificaOp;
        verificaOp = super.operaInsertDeleteUpdate(strComEditar);
        
        return verificaOp;
    }
    
    @Override
    public DefaultTableModel mostrar() throws Exception{
        String consulta;
        consulta = "SELECT AUT_CODIGO AS CODIGO, AUT_NOMBRE AS NOMBRE, AUT_DESCRIPCION AS DESCRIPCION FROM CAT_AUT_AUTOR;";
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    @Override
    public DefaultTableModel buscar() throws Exception{
        String consulta;
        String filtro1 = this.nombre.replace(" ", "%");
        consulta = String.format("SELECT AUT_CODIGO AS CODIGO, AUT_NOMBRE AS NOMBRE, AUT_DESCRIPCION AS DESCRIPCION FROM CAT_AUT_AUTOR WHERE AUT_NOMBRE LIKE '%1$s';", filtro1);
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    @Override
    public int ejecutarOperacion(String prComando){
        int verificaOp;
        verificaOp = super.operaInsertDeleteUpdate(prComando);
        
        return verificaOp;
    }

}
