using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tp5
{
    public class Periodique : Ouvrage
    {
        private int id;
        private int numero;
        private string periodicite;
        private DateTime created_at;

        public Periodique(string name, int numero, string periodicite) :base(name)
        {
            this.numero = numero;
            this.periodicite = periodicite;
        }
       

    }
}
