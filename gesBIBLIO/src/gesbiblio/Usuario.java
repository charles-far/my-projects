package gesbiblio;

import javax.swing.table.DefaultTableModel;

public class Usuario extends Sqlite implements OperacionesBD {
    String atrCodigoUsu, atrNombres, atrApellidos, atrFecha, atrDpi, atrTipo;
    int opResultado;
    
    public Usuario(String prCodigoUsu, String prNombres, String prApellidos, String prFecha, String prDpi, String prTipo){
        this.atrCodigoUsu = prCodigoUsu; 
        this.atrNombres = prNombres; 
        this.atrApellidos = prApellidos; 
        this.atrFecha = prFecha; 
        this.atrDpi = prDpi; 
        this.atrTipo = prTipo; 
   }
    
    /**
     * Para busqueda
     * @param prNombres 
     * @param prFecha 
     * @param prDpi 
     */
    public Usuario(String prNombres, String prFecha, String prDpi){
        this.atrNombres = prNombres; 
        this.atrFecha = prFecha; 
        this.atrDpi = prDpi; 
    }    
    
    public Usuario(String prCodigoUsu){
        this.atrCodigoUsu = prCodigoUsu;
    }
    
    public Usuario(){
        //Para instanciar sin parámetros
    }
    
    @Override
    public int agregar(){
        String strComAgregar;
        strComAgregar = String.format("INSERT INTO GES_USU_USUARIO VALUES (NULL, '%1$s', '%2$s', '%3$s', '%4$s', '%5$s');", 
                this.atrNombres, this.atrApellidos, this.atrFecha, this.atrDpi, this.atrTipo);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComAgregar);
        return opResultado;
    }
    
    @Override
    public int eliminar(){
        String strComEliminar;
        strComEliminar = String.format("DELETE FROM GES_USU_USUARIO WHERE USU_CODIGO = %1$s;", this.atrCodigoUsu);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComEliminar);
        return opResultado;
    }
    
    @Override
    public int editar(){
        String strComEditar;
        strComEditar = String.format("UPDATE GES_USU_USUARIO SET USU_NOMBRES = '%1$s', USU_APELLIDOS = '%2$s', USU_FECHA_NAC = '%3$s', USU_DPI = '%4$s', "
                + "USU_TIPO = '%5$s' WHERE USU_CODIGO = %6$s;", 
                this.atrNombres, this.atrApellidos, this.atrFecha, this.atrDpi, this.atrTipo, this.atrCodigoUsu);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComEditar);
        return opResultado;
    }
    
    @Override
    public DefaultTableModel mostrar() throws Exception{
        String consulta;
        consulta = "SELECT USU_CODIGO AS CODIGO, USU_NOMBRES AS NOMBRES, USU_APELLIDOS AS APELLIDOS, USU_FECHA_NAC AS FECHA_NAC, USU_DPI AS DPI, USU_TIPO AS TIPO ";
        consulta += "FROM GES_USU_USUARIO;";
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    @Override
    public DefaultTableModel buscar() throws Exception{
        String consulta;
        String select;
        String filtro1 = this.atrNombres.replace(" ", "%");
        String filtro2 = this.atrDpi.replace(" ", "%");
        String filtro3 = this.atrFecha.replace(" ", "%");
        
        select = "SELECT USU_CODIGO AS CODIGO, USU_NOMBRES AS NOMBRES, USU_APELLIDOS AS APELLIDOS, USU_FECHA_NAC AS FECHA_NAC, USU_DPI AS DPI, USU_TIPO AS TIPO ";
        select += "FROM GES_USU_USUARIO ";
        consulta = String.format(select + " WHERE USU_NOMBRES LIKE '%1$s' OR USU_DPI LIKE '%2$s' OR USU_FECHA_NAC LIKE '%3$s';", filtro1, filtro2, filtro3);
        
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
