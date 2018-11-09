package gesbiblio;

import javax.swing.table.DefaultTableModel;

public interface OperacionesBD {
    public int agregar();
    
    public int eliminar();
    
    public int editar();
    
    public DefaultTableModel mostrar() throws Exception;
    
    public DefaultTableModel buscar() throws Exception;
    
    public int ejecutarOperacion(String comando);
}
