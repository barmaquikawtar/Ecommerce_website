using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tp5
{
    public class CD : Ouvrage
    {
        private int id;
        private string auteur;
        private DateTime created_at;

        public CD(string name, string auteur) :base(name)
        {
            this
            this.auteur = auteur;
        }

      /*  public override string ToString()
        {
            return base.ToString() + " " + auteur + " " + titre ;
        }*/
    }
}
