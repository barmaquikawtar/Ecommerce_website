using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tp5
{
    public class Ouvrage
    {
        private int id;
        private string name;
        private DateTime created_at;

        public Ouvrage(string name)
        {
            this.name = name;
        }

       /* public override string ToString()
        {
            return this.date_emprint.ToString();
        }*/

      
    }
}
