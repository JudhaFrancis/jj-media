"use client";

import { motion, useScroll, useTransform, useInView } from "framer-motion";
import { useRef, useEffect, useState } from "react";

const stats = [
  { target: 120, label: "Projects Done" },
  { target: 6, label: "Active Sites" },
  { target: 50, label: "Brand Partners" },
  { target: 5, label: "Years Exp" },
];

function StatNumber({ target, label }: { target: number; label: string }) {
  const ref = useRef(null);
  const isInView = useInView(ref, { once: true });
  const [count, setCount] = useState(0);

  useEffect(() => {
    if (isInView) {
      let start = 0;
      const end = target;
      const duration = 2000;
      const increment = end / (duration / 30);
      
      const timer = setInterval(() => {
        start += increment;
        if (start >= end) {
          setCount(end);
          clearInterval(timer);
        } else {
          setCount(Math.floor(start));
        }
      }, 30);
      return () => clearInterval(timer);
    }
  }, [isInView, target]);

  return (
    <div ref={ref} className="p-10 border border-white/10 bg-brand-bg rounded-none text-center">
      <div className="text-4xl md:text-5xl font-heading font-black text-brand-gold mb-2">
        {count}{target > 5 ? "+" : ""}
      </div>
      <div className="text-[10px] uppercase tracking-widest text-brand-muted">
        {label}
      </div>
    </div>
  );
}

export default function About() {
  return (
    <section id="about" className="py-24 md:py-32 bg-brand-card/30 relative">
      <div className="container mx-auto px-6 md:px-24">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
          <motion.div
            initial={{ opacity: 0, x: -30 }}
            whileInView={{ opacity: 1, x: 0 }}
            viewport={{ once: true }}
            transition={{ duration: 0.8 }}
          >
            <span className="text-brand-gold uppercase tracking-[0.3em] text-xs font-bold mb-6 block">Who We Are</span>
            <h2 className="text-5xl md:text-7xl font-heading font-black mb-10 leading-tight">
              Crafted for <span className="italic text-brand-gold">Impact.</span>
            </h2>
            <p className="text-xl text-brand-muted leading-relaxed mb-8">
              JJ Media House bridges creative excellence with India's fastest-growing markets. We are architects of visibility, specializing in high-frequency outdoor assets that command attention in an age of distraction.
            </p>
            <p className="text-brand-muted leading-relaxed">
              With over 5 years of experience in the Bengaluru market, we have evolved from traditional billboards to a multi-platform media powerhouse, serving some of the biggest names in tech, retail, and real estate.
            </p>
          </motion.div>

          <div className="grid grid-cols-2 gap-6">
            {stats.map((stat, idx) => (
              <StatNumber key={idx} {...stat} />
            ))}
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-12 mt-24">
          {[
            { num: "01", title: "Origin", desc: "From Lagos to Bengaluru — a global aesthetic meets local market mastery." },
            { num: "02", title: "Method", desc: "Data-driven placement focusing on traffic density and sight-line optimization." },
            { num: "03", title: "Future", desc: "Pioneering programmatic DOOH assets that adapt in real-time to traffic flow." },
          ].map((item, idx) => (
            <motion.div 
              key={idx}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ delay: 0.5 + (idx * 0.1) }}
              className="flex space-x-6"
            >
              <span className="text-brand-gold font-heading text-4xl font-bold opacity-30">{item.num}</span>
              <div>
                <h4 className="font-bold uppercase tracking-widest text-sm mb-3">{item.title}</h4>
                <p className="text-brand-muted text-sm leading-relaxed">{item.desc}</p>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  );
}
