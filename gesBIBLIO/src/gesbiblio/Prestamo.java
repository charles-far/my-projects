package gesbiblio;

import javax.swing.table.DefaultTableModel;

public class Prestamo extends Sqlite implements OperacionesBD {
    String atrPreCodigo, atrPreFch, atrPreCodLib, atrPreCodUsu, atrPreEstado;
    int opResultado;
    
    public Prestamo(String prPreCodigo, String prPreCodLib, String prPreCodUsu){
        this.atrPreCodigo = prPreCodigo; 
        this.atrPreCodLib = prPreCodLib; 
        this.atrPreCodUsu = prPreCodUsu; 
    }

    public Prestamo(String prPreCodigo){
        this.atrPreCodigo = prPreCodigo;
    }
    
    public Prestamo(){
        //Para instanciar sin parámetros
    }
    
    @Override
    public int agregar(){
        String strComAgregar;
        strComAgregar = String.format("INSERT INTO GES_PRE_PRESTAMO VALUES (NULL, datetime('now'), '%1$s', '%2$s', 'ABIERTO');", this.atrPreCodLib, this.atrPreCodUsu);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComAgregar);
        return opResultado;
    }
    
    @Override
    public int eliminar(){
        return 0;
    }
    
    @Override
    public int editar(){
        String strComEditar;
        strComEditar = String.format("UPDATE GES_PRE_PRESTAMO SET PRE_ESTADO = 'CERRADO' WHERE PRE_CODIGO = %1$s;", this.atrPreCodigo);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComEditar);
        return opResultado;
    }
    
    @Override
    public DefaultTableModel mostrar() throws Exception{
        String consulta;
        consulta = "SELECT PRE_CODIGO AS CODIGO, PRE_FECHA AS FECHA, LIB_TITULO AS LIBRO, USU_NOMBRES AS USUARIO, USU_DPI AS DPI, PRE_ESTADO AS ESTADO ";
        consulta += "FROM GES_PRE_PRESTAMO ";
        consulta += "JOIN GES_LIB_LIBRO ON PRE_CODIGO_LIBRO = LIB_ISBN ";
        consulta += "JOIN GES_USU_USUARIO ON PRE_CODIGO_USUARIO = USU_DPI ";
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    public DefaultTableModel mostrarPrestamo() throws Exception{
        String consulta;
        consulta = "SELECT PRE_CODIGO AS CODIGO, PRE_FECHA AS FECHA, LIB_TITULO AS LIBRO, USU_NOMBRES AS USUARIO, USU_TIPO AS DPI, PRE_ESTADO AS ESTADO ";
        consulta += "FROM GES_PRE_PRESTAMO ";
        consulta += "JOIN GES_LIB_LIBRO ON PRE_CODIGO_LIBRO = LIB_ISBN ";
        consulta += "JOIN GES_USU_USUARIO ON PRE_CODIGO_USUARIO = USU_DPI ";
        consulta += "ORDER BY PRE_FECHA DESC; ";
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    public DefaultTableModel mostrarUsuarios() throws Exception{
        String consulta;
        consulta = "SELECT * FROM VW_USUARIO_LIBROS_PRESTADOS;";
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
        public DefaultTableModel mostrarUsuarios(String prDpi) throws Exception{
        String consulta;
        consulta = String.format("SELECT * FROM VW_USUARIO_LIBROS_PRESTADOS WHERE DPI = '%1$s';", prDpi);
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    @Override
    public DefaultTableModel buscar() throws Exception{
        String consulta;
        
        consulta = "SELECT ";
        consulta += "    LIB_ISBN AS ISBN, ";
        consulta += "    LIB_TITULO AS TITULO, ";
        consulta += "    CASE ";
        consulta += "        WHEN IFNULL(PRE_ESTADO, 'NULO') = 'NULO' THEN 'DISPONIBLE' ";
        consulta += "        ELSE 'PRESTADO' ";
        consulta += "    END AS ESTADO ";
        consulta += "FROM GES_LIB_LIBRO "; 
        consulta += "LEFT JOIN GES_PRE_PRESTAMO ON LIB_ISBN = PRE_CODIGO_LIBRO AND PRE_ESTADO = 'ABIERTO' ";
        consulta += "WHERE ";
        consulta += "    CASE ";
        consulta += "        WHEN IFNULL(PRE_ESTADO, 'NULO') = 'NULO' THEN 'DISPONIBLE' ";
        consulta += "        ELSE 'PRESTADO' ";
        consulta += "    END = 'DISPONIBLE' ";

        DefaultTableModel res;
        
        res = super.select(consulta);

        return res;
    }
    
    public DefaultTableModel buscarLibro(String prIsbn) throws Exception{
        String consulta;
        String vlIsbn = prIsbn;
        vlIsbn = vlIsbn.replace(" ", "%");
        
        consulta = "SELECT LIB_ISBN, LIB_TITULO AS TITULO, IFNULL(PRE_ESTADO, 'HABILITADO') AS ESTADO FROM GES_LIB_LIBRO ";
        consulta += "LEFT JOIN GES_PRE_PRESTAMO ON LIB_ISBN = PRE_CODIGO_LIBRO AND PRE_ESTADO = 'Abierto' WHERE LIB_ISBN LIKE '" + vlIsbn + "'";

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
