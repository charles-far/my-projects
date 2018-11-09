package gesbiblio;

import javax.swing.table.DefaultTableModel;

public class Libro extends Sqlite implements OperacionesBD {
    String atrCodigolibro, atrTitulo, atrAutor, atrEdicion, atrEditorial, atrAnioPub, atrIsbn, atrGenero;
    int opResultado;
    
    public Libro(String prCodigolibro, String prTitulo, String prAutor, String prEdicion, String prEditorial, String prAnioPub, String prIsbn, String prGenero){
        this.atrCodigolibro = prCodigolibro; 
        this.atrTitulo = prTitulo; 
        this.atrAutor = prAutor; 
        this.atrEdicion = prEdicion; 
        this.atrEditorial = prEditorial; 
        this.atrAnioPub = prAnioPub; 
        this.atrIsbn = prIsbn;
        this.atrGenero = prGenero;
    }
    
    /**
     * Para busqueda
     * @param prTitulo
     * @param prAutor
     * @param prEdicion
     * @param prEditorial
     * @param prAnioPub
     * @param prIsbn
     * @param prGenero
     */
    public Libro(String prTitulo, String prAutor, String prEdicion, String prEditorial, String prAnioPub, String prIsbn, String prGenero){
        this.atrTitulo = prTitulo; 
        this.atrAutor = prAutor; 
        this.atrEdicion = prEdicion; 
        this.atrEditorial = prEditorial; 
        this.atrAnioPub = prAnioPub; 
        this.atrIsbn = prIsbn;
        this.atrGenero = prGenero;
    }    
    
    public Libro(String prCodigolibro){
        this.atrCodigolibro = prCodigolibro; 
    }
    
    public Libro(){
        //Para instanciar sin parámetros
    }
    
    @Override
    public int agregar(){
        String strComAgregar;
        strComAgregar = String.format("INSERT INTO GES_LIB_LIBRO VALUES (NULL, '%1$s', '%2$s', '%3$s', '%4$s', '%5$s', %6$s, '%7$s', datetime('now'));", 
                this.atrTitulo, this.atrAutor, this.atrIsbn, this.atrEdicion, this.atrEditorial, this.atrAnioPub, this.atrGenero);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComAgregar);
        return opResultado;
    }
    
    @Override
    public int eliminar(){
        String strComEliminar;
        strComEliminar = String.format("DELETE FROM GES_LIB_LIBRO WHERE LIB_CODIGO = %1$s;", this.atrCodigolibro);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComEliminar);
        return opResultado;
    }
    
    @Override
    public int editar(){
        String strComEditar;
        strComEditar = String.format("UPDATE GES_LIB_LIBRO SET LIB_TITULO = '%1$s', LIB_AUTOR = '%2$s', LIB_ISBN = '%3$s', LIB_NUM_EDICION = '%4$s', "
                + "LIB_EDITORIAL = '%5$s', LIB_ANIO_PUBLICACION = %6$s, LIB_GENERO = '%7$s' WHERE LIB_CODIGO = %8$s;", 
                this.atrTitulo, this.atrAutor, this.atrIsbn, this.atrEdicion, this.atrEditorial, this.atrAnioPub,  this.atrGenero, this.atrCodigolibro);
        
        opResultado = -1;
        opResultado = this.ejecutarOperacion(strComEditar);
        return opResultado;
    }
    
    @Override
    public DefaultTableModel mostrar() throws Exception{
        String consulta;
        consulta = "SELECT LIB_CODIGO AS CODIGO, LIB_TITULO AS TITULO, LIB_AUTOR AS AUTOR, LIB_ISBN AS ISBN, LIB_NUM_EDICION AS EDICION, ";
        consulta += "LIB_EDITORIAL AS EDITORIAL, LIB_ANIO_PUBLICACION AS PUBLICADO, LIB_GENERO AS GENERO, LIB_FECHA_INGRESO AS REGISTRADO ";
        consulta += "FROM GES_LIB_LIBRO;";
        
        DefaultTableModel res;
        
        res = super.select(consulta);
        
        return res;
    }
    
    @Override
    public DefaultTableModel buscar() throws Exception{
        String consulta;
        String select;
        
        String filtro1 = this.atrTitulo.replace(" ", "%");
        String filtro2 = this.atrAutor.replace(" ", "%");
        String filtro3 = this.atrEditorial.replace(" ", "%");
        String filtro4 = this.atrAnioPub.replace(" ", "%");
        String filtro5 = this.atrGenero.replace(" ", "%");
        String filtro6 = this.atrIsbn.replace(" ", "%");
        
        select = "SELECT LIB_CODIGO AS CODIGO, LIB_TITULO AS TITULO, LIB_AUTOR AS AUTOR, LIB_ISBN AS ISBN, LIB_NUM_EDICION AS EDICION, ";
        select += "LIB_EDITORIAL AS EDITORIAL, LIB_ANIO_PUBLICACION AS PUBLICADO, LIB_GENERO AS GENERO, LIB_FECHA_INGRESO AS REGISTRADO ";
        select += "FROM GES_LIB_LIBRO";
        consulta = String.format(select + " WHERE LIB_TITULO LIKE '%1$s' OR LIB_AUTOR LIKE '%2$s' OR LIB_EDITORIAL LIKE '%3$s' OR "
                + "LIB_ANIO_PUBLICACION = %4$s OR LIB_GENERO LIKE '5$s' OR LIB_ISBN LIKE '6$s';",
                filtro1, filtro2, filtro3, filtro4, filtro5, filtro6);
        
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
