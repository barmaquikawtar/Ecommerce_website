using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Tp5
{
    public class Livre:Ouvrage
    {
        private int id;
        private string auteur;
        private string editeur;
        private DateTime created_at;

        public Livre(string name, string auteur, string editeur) :base(name)
        {
            this.auteur = auteur;
            this.editeur = editeur;
        }
      

       

       
    }
}
