package gesbiblio;

import java.sql.*;
import java.util.ArrayList;
import java.util.List;
import java.util.logging.Level;
import java.util.logging.Logger;
import javax.swing.JTable;
import javax.swing.table.DefaultTableModel;


public class Sqlite {
    Connection conn = null;
    Statement statement = null;
    ResultSet rs = null;
    static int rowCount = 0;
    
    private void conectar(){
        try {
            Class.forName("org.sqlite.JDBC");
            //conn = DriverManager.getConnection("jdbc:sqlite://c:\\sqlite\\Prueba2.db");
            conn = DriverManager.getConnection("jdbc:sqlite://c:\\sqlite\\SQLITE_BIBLIOGES.db");
            statement = conn.createStatement();
        } catch (ClassNotFoundException | SQLException ex) {
            Logger.getLogger(Sqlite.class.getName()).log(Level.SEVERE, null, ex);
        }
    }
    
    private ResultSet getQryResults(String strQuery){
        try {
            conectar();
            String SQL = strQuery; //Consulta a base de datos
            rs = statement.executeQuery(SQL);
        } catch (SQLException ex) {
            Logger.getLogger(Sqlite.class.getName()).log(Level.SEVERE, null, ex);
        }

        return rs;
    }

    /**
     * Opera insert, update, delete en el mismo método
     * @param strComando
     * @return 
     */
    public int operaInsertDeleteUpdate(String strComando){
        int retornoOperacion;
        retornoOperacion = 0;
        
        try {
            conectar();
            String SQL = strComando;
            retornoOperacion = statement.executeUpdate(SQL);
        } catch (SQLException ex) {
            Logger.getLogger(Sqlite.class.getName()).log(Level.SEVERE, null, ex);
        }

        return retornoOperacion;
    }
    
    /**
     * Regresa tabla
     * @param strQuery
     * @return 
     * @throws java.lang.Exception 
    */
    public JTable getInfo(String strQuery) throws Exception{
        getQryResults(strQuery);

        // Crea nueva tabla basada en el modelo del resultado de la consulta
        JTable table = new JTable(buildTableModel(rs));
        return table;
    }
    
    /**
     * Regresa modelo de tabla
     * @param strQuery
     * @return 
     * @throws java.lang.Exception
    */
    protected DefaultTableModel select(String strQuery) throws Exception{
        getQryResults(strQuery);
       
        // Regresa modelo e información
        return buildTableModel(rs);
    }

    // Clase local
    public static DefaultTableModel buildTableModel(ResultSet res) throws SQLException {
        ResultSetMetaData metaData = res.getMetaData();
        
        // Obtener los nombres de las columnas
        int columnCount = metaData.getColumnCount();
        Object[] colNom = new Object[columnCount];

        for (int column = 1; column <= columnCount; column++) {
            colNom[column - 1] = metaData.getColumnName(column);
        }
        
        // Obtener la información
        List<String[]> list;
        list = new ArrayList<>();

        while (res.next()) {
            String[] fila = new String[columnCount];
            for (int columnIndex = 1; columnIndex <= columnCount; columnIndex++) {
                fila[columnIndex - 1] = (res.getObject(columnIndex)).toString();
            }
            
            list.add(fila);
        }
        
        Object[][] data2 = new Object[list.size()][];
        list.toArray(data2);
        
        return new DefaultTableModel(data2, colNom) {@Override
        public boolean isCellEditable(int row, int column) { return false; }};
    }
}
