using SQLite;
using System;
using System.Collections.Generic;
using System.ComponentModel.DataAnnotations.Schema;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace proyecto.Modelos
{

    public class Usuario
    {        
        public int id {  get; set; }
        public string documento { get; set; }
        public string nombres { get; set; }
        public string apellidos { get; set; }
        public string correo { get; set; }
        public string telefono { get; set; }
        public string password { get; set; }
        public int rol {  get; set; }
        public string ubicacion {  get; set; }
        public string negocio { get; set; }
        public string detalle {  get; set; }
        public string referencias {  get; set; }

    }
}
